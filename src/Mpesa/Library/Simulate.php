<?php

namespace Samerior\MobileMoney\Mpesa\Library;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use GuzzleHttp\Exception\ClientException;
use Samerior\MobileMoney\Mpesa\Library\Core\ApiCore;

/**
 * Class Simulate
 * @package Samerior\MobileMoney\Mpesa\Library
 */
class Simulate extends ApiCore
{
    /**
     * @var string
     */
    private $amount;
    /**
     * @var int
     */
    private $number;
    /**
     * @var string
     */
    private $command = 'CustomerPayBillOnline';
    //CustomerBuyGoodsOnline
    /**
     * @var string
     */
    private $reference = 'Testing';

    /**
     * Set the request amount to be deducted.
     *
     * @param int $amount
     *
     * @return $this
     * @throws \Exception
     * @throws MpesaException
     */
    public function request($amount): self
    {
        if (!\is_numeric($amount)) {
            throw new MpesaException('The amount must be numeric');
        }
        $this->amount = $amount;
        return $this;
    }

    /**
     * Set the Mobile Subscriber Number to deduct the amount from.
     * Must be in format 2547XXXXXXXX.
     *
     * @param string $number
     *
     * @return $this
     * @throws MpesaException
     */
    public function from($number): self
    {
        if (!starts_with($number, '2547')) {
            throw new MpesaException('The subscriber number must start with 2547');
        }
        $this->number = $number;
        return $this;
    }

    /**
     * Set the product reference number to bill the account.
     *
     * @param int $reference
     *
     * @return $this
     */
    public function usingReference($reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Set the unique command for this transaction type.
     *
     * @param string $command
     *
     * @return $this
     * @throws MpesaException
     */
    public function setCommand($command): self
    {
        if (!\in_array($command, self::VALID_COMMANDS, true)) {
            throw new MpesaException('Invalid command sent');
        }
        $this->command = $command;
        return $this;
    }

    /**
     * Prepare the transaction simulation request
     *
     * @param int $amount
     * @param int $number
     * @param string $reference
     * @param string $command
     * @return mixed
     * @throws MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function push($number = null, $amount = null, $reference = null, $command = null)
    {
        if (!\config('samerior.mpesa.sandbox', true)) {
            throw new MpesaException('Cannot simulate a transaction in the live environment.');
        }
        $shortCode = \config('samerior.mpesa.c2b.short_code');
        $good_phone = $this->formatPhoneNumber($number ?: $this->number);
        $body = [
            'CommandID' => $command ?: $this->command,
            'Amount' => $amount ?: $this->amount,
            'Msisdn' => $good_phone,
            'ShortCode' => $shortCode,
            'BillRefNumber' => $reference ?: $this->reference,
        ];
        try {
            return $this->sendRequest($body, 'simulate');
        } catch (ClientException $exception) {
            return \json_decode($exception->getResponse()->getBody());
        }
    }
}
