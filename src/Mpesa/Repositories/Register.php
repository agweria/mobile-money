<?php

namespace Samerior\MobileMoney\Mpesa\Repositories;

use Samerior\MobileMoney\Mpesa\Library\RegisterUrl;

/**
 * Class Register
 * @package Samerior\MobileMoney\Mpesa\Repositories
 */
class Register
{
    /**
     * @var RegisterUrl
     */
    private $registra;

    /**
     * Register constructor.
     * @param RegisterUrl $registerUrl
     */
    public function __construct(RegisterUrl $registerUrl)
    {
        $this->registra = $registerUrl;
    }

    /**
     * @return mixed
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doRegister()
    {
        return $this->registra->register(\config('samerior.mpesa.c2b.short_code'))
            ->onConfirmation(\config('samerior.mpesa.c2b.confirmation_url'))
            ->onValidation(\config('samerior.mpesa.c2b.validation_url'))
            ->submit();
    }
}
