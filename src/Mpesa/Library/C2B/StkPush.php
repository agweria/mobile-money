<?php

namespace Samerior\MobileMoney\Mpesa\Library\C2B;

use Carbon\Carbon;
use Samerior\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest;
use Samerior\MobileMoney\Mpesa\Events\StkPushRequestedEvent;
use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use Samerior\MobileMoney\Mpesa\Library\Core\ApiCore;
use Samerior\MobileMoney\Mpesa\Repositories\Generator;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

/**
 * Class StkPush
 * @package Samerior\MobileMoney\Mpesa\Library
 */
class StkPush extends ApiCore
{
    /**
     * @var string
     */
    protected $number;
    /**
     * @var int
     */
    protected $amount;
    /**
     * @var string
     */
    protected $account_reference;
    /**
     * @var string
     */
    protected $description;

    /**
     * Set the amount you are requesting the user to pay
     * @param string $amount
     * @return StkPush
     * @throws \Throwable
     */
    public function requestAmount($amount): StkPush
    {
        throw_unless(is_numeric($amount), MpesaException::class, 'The amount must be numeric. Got ' . $amount);
        throw_if($amount > 70000, MpesaException::class, 'The maximum allowed amount for this API is Ksh 70,000. Got ' . $amount);
        $this->amount = (int)$amount;
        return $this;
    }

    /**
     * Set the [customer] number which will make the transactions
     * @param string $number
     * @return StkPush
     * @throws \Throwable
     */
    public function fromNumber($number): StkPush
    {
        $this->number = $this->formatPhoneNumber($number);
        return $this;
    }

    /**
     * Set the mpesa account reference
     *
     * @param  string $account
     * @return StkPush
     * @throws \Throwable
     */
    public function toAccount($account = null): StkPush
    {
        if (empty($account)) {
            $account = $this->number; // just in case you didn't supply this
        }
        $this->account_reference = $account;
        return $this;
    }

    /**
     * Set the transaction description
     * @param string|null $description
     * @return StkPush
     */
    public function usingDescription($description = null): StkPush
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Send a payment request
     * @return mixed
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     * @throws \Throwable
     */
    public function push()
    {
        $time = Carbon::now()->format('YmdHis');
        $shortCode =$this->core->config->get('c2b.short_code');
        $passkey =$this->core->config->get('c2b.passkey');
        $callback =$this->core->config->get('c2b.stk_callback');
        $password = \base64_encode($shortCode . $passkey . $time);
        $body = [
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $time,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $this->amount,
            'PartyA' => $this->number,
            'PartyB' => $shortCode,
            'PhoneNumber' => $this->number,
            'CallBackURL' => $callback,
            'AccountReference' => $this->account_reference ?? $this->number,
            'TransactionDesc' => $this->description ?? Generator::generateTransactionNumber(),
        ];
        $response = $this->sendRequest($body, 'stk_push');
        return $this->saveStkRequest($body, (array)$response);
    }


    private function _validate()
    {
        $needed = ['amount', 'number',];
    }

    /**
     * @param array $body
     * @param array $response
     * @return MpesaStkRequest|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     * @throws MpesaException
     */
    private function saveStkRequest($body, $response)
    {
        if ($response['ResponseCode'] == 0) {
            $incoming = [
                'phone' => $body['PartyA'],
                'amount' => $body['Amount'],
                'reference' => $body['AccountReference'],
                'description' => $body['TransactionDesc'],
                'CheckoutRequestID' => $response['CheckoutRequestID'],
                'MerchantRequestID' => $response['MerchantRequestID'],
                'user_id' => @(Auth::id() ?: request('user_id')),
            ];
            $stk = MpesaStkRequest::create($incoming);
            event(new StkPushRequestedEvent($stk, request()));
            return $stk;
        }
        throw new MpesaException($response['ResponseDescription']);
    }

    /**
     * Validate an initialized transaction.
     *
     * @param string|int $checkoutRequestID
     *
     * @return mixed
     * @throws MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate($checkoutRequestID)
    {
        if ((int)$checkoutRequestID) {
            $checkoutRequestID = MpesaStkRequest::find($checkoutRequestID)->CheckoutRequestID;
        }
        $time = Carbon::now()->format('YmdHis');
        $shortCode =$this->core->config->get('c2b.short_code');
        $passkey =$this->core->config->get('c2b.passkey');
        $password = \base64_encode($shortCode . $passkey . $time);
        $body = [
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $time,
            'CheckoutRequestID' => $checkoutRequestID,
        ];
        try {
            return $this->sendRequest($body, 'stk_status');
        } catch (RequestException $exception) {
            throw new MpesaException($exception->getMessage());
        }
    }
}
