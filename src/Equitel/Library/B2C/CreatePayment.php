<?php

namespace Samerior\MobileMoney\Equitel\Library\B2C;

use Samerior\MobileMoney\Equitel\Exceptions\EquitelException;
use Samerior\MobileMoney\Equitel\Library\Core\ApiCore;

/**
 * Class CreatePayment
 * @package Samerior\MobileMoney\Equitel\Library\B2C
 */
class CreatePayment extends ApiCore
{
    /*
     *  $url = $this->repository->endpoint->transaction . '/payments';
            return Curl::to($url)
                ->withHeader('Authorization: Bearer ' . $this->bearer)
                ->returnResponseObject()
                ->withData([
                    'customer' => [
                        'mobileNumber' => '254763555289'
                    ],
                    'transaction' => [
                        "amount" => "50000",
                        "description" => "Payment",
                        "type" => "StkRequest Payment",
                        "auditNumber" => $this->transactionNumber,
                    ]
                ])
                ->asJson()
                ->post();
     */
    /**
     * @var string
     */
    private $number;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var string
     */
    private $reference;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $type = 'Paybill';//'StkRequest Payment'

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function submit()
    {
        $body = [
            'customer' => [
                'mobileNumber' => $this->number
            ],
            'transaction' => [
                'amount' => $this->amount,
                'description' => $this->description,
                'type' => $this->type,
                'auditNumber' => $this->reference,
                'reference' => $this->reference,
            ]
        ];
        return $this->sendRequest($body, 'create_payment');
    }

    /**
     * Set the mpesa account reference
     *
     * @param  string $account
     * @return CreatePayment
     * @throws \Throwable
     */
    public function toAccount($account = null): CreatePayment
    {
        if ($account === null) {
            $account = $this->number; // just in case you didn't supply this
        }
        $this->reference = $account;
        return $this;
    }

    /**
     * Set the amount you are requesting the user to pay
     * @param string $amount
     * @return CreatePayment
     * @throws \Throwable
     */
    public function requestAmount($amount): CreatePayment
    {
        throw_unless(is_numeric($amount), EquitelException::class, 'The amount must be numeric. Got ' . $amount);
        throw_if($amount > 70000, EquitelException::class, 'The maximum allowed amount for this API is Ksh 70,000. Got ' . $amount);
        $this->amount = (int)$amount;
        return $this;
    }

    /**
     * Set the transaction description
     * @param string|null $description
     * @return CreatePayment
     */
    public function usingDescription($description = null): CreatePayment
    {
        if ($description === null) {
            $description = 'Customer Payment by API ' . date('YmdHis');
        }
        $this->description = $description;
        return $this;
    }

    /**
     * Set the [customer] number which will make the transactions
     * @param string $number
     * @return CreatePayment
     * @throws \Throwable
     */
    public function fromNumber($number): CreatePayment
    {
        $this->number = $this->formatPhoneNumber($number);
        return $this;
    }
}