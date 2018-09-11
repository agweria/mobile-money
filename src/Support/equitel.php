<?php

use Samerior\MobileMoney\Equitel\Facades\Equitel;

if (!function_exists('equitel_request')) {
    /**
     * @param string $phone
     * @param int $amount
     * @param string|null $reference
     * @param string|null $description
     * @return mixed
     */
    function equitel_request($phone, $amount, $reference = null, $description = null)
    {
        return Equitel::requestAmount($amount)
            ->fromNumber($phone)
            ->toAccount($reference)
            ->usingDescription($description)
            ->submit();
    }
}