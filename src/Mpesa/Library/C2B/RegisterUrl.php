<?php

namespace Samerior\MobileMoney\Mpesa\Library\C2B;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use Samerior\MobileMoney\Mpesa\Library\Core\ApiCore;

/**
 * Class RegisterUrl
 * @package Samerior\MobileMoney\Mpesa\Library
 */
class RegisterUrl extends ApiCore
{
    /**
     * The short code to register callbacks for.
     *
     * @var string
     */
    protected $shortCode;
    /**
     * The validation callback.
     *
     * @var
     */
    protected $validationURL;
    /**
     * The confirmation callback.
     *
     * @var
     */
    protected $confirmationURL;
    /**
     * The status of the request in case a timeout occurs.
     *
     * @var string
     */
    protected $onTimeout = 'Completed';

    /**
     * @param $shortCode
     * @return RegisterUrl
     */
    public function register($shortCode): RegisterUrl
    {
        $this->shortCode = $shortCode;
        return $this;
    }

    /**
     * Set the validation URL
     * @param string $validationURL
     * @return RegisterUrl
     */
    public function onValidation($validationURL): RegisterUrl
    {
        $this->validationURL = $validationURL;
        return $this;
    }

    /**
     * Set the confirmation URL
     * @param $confirmationURL
     * @return RegisterUrl
     */
    public function onConfirmation($confirmationURL): RegisterUrl
    {
        $this->confirmationURL = $confirmationURL;
        return $this;
    }

    /**
     * Set the timeout URL
     * @param string $onTimeout
     * @return RegisterUrl
     * @throws \Exception
     * @throws MpesaException
     */
    public function onTimeout($onTimeout = 'Completed'): RegisterUrl
    {
        if ($onTimeout !== 'Completed' && $onTimeout !== 'Cancelled') {
            throw new MpesaException('Invalid timeout argument. Use Completed or Cancelled');
        }
        $this->onTimeout = $onTimeout;
        return $this;
    }

    /**
     * Send RegisterURL request to mpesa
     * @return mixed
     * @throws MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function submit()
    {
        $body = [
            'ShortCode' => $this->shortCode,
            'ResponseType' => $this->onTimeout,
            'ConfirmationURL' => $this->confirmationURL,
            'ValidationURL' => $this->validationURL
        ];
        return $this->sendRequest($body, 'register');
    }
}
