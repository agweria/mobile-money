<?php

namespace Samerior\MobileMoney\Equitel\Library\B2C;

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
    private $number;

    public function submit()
    {

    }

    /**
     * Set the [customer] number which will make the transactions
     * @param string $number
     * @return CreatePayment
     */
    public function fromNumber($number): CreatePayment
    {
//        $this->number = $this->formatPhoneNumber($number);
        $this->number = $number; //todo Format number to required format if necessary
        return $this;
    }
}