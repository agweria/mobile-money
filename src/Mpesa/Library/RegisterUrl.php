<?php

namespace Samerior\MobileMoney\Mpesa\Library;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;

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
     * @return $this
     */
    public function register($shortCode)
    {
        $this->shortCode = $shortCode;
        return $this;
    }

    /**
     * @param string $validationURL
     * @return $this
     */
    public function onValidation($validationURL)
    {
        $this->validationURL = $validationURL;
        return $this;
    }

    /**
     * @param $confirmationURL
     * @return $this
     */
    public function onConfirmation($confirmationURL)
    {
        $this->confirmationURL = $confirmationURL;
        return $this;
    }

    /**
     * @param string $onTimeout
     * @return $this
     * @throws \Exception
     * @throws MpesaException
     */
    public function onTimeout($onTimeout = 'Completed')
    {
        if ($onTimeout !== 'Completed' && $onTimeout !== 'Cancelled') {
            throw new MpesaException('Invalid timeout argument. Use Completed or Cancelled');
        }
        $this->onTimeout = $onTimeout;
        return $this;
    }

    /**
     * @param string|null $shortCode
     * @param string|null $confirmationURL
     * @param string|null $validationURL
     * @param string|null $onTimeout
     * @return mixed
     * @throws MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit($shortCode = null, $confirmationURL = null, $validationURL = null, $onTimeout = null)
    {
        if ($onTimeout && $onTimeout !== 'Completed' && $onTimeout = 'Cancelled') {
            throw new MpesaException('Invalid timeout argument. Use Completed or Cancelled');
        }
        $body = [
            'ShortCode' => $shortCode ?: $this->shortCode,
            'ResponseType' => $onTimeout ?: $this->onTimeout,
            'ConfirmationURL' => $confirmationURL ?: $this->confirmationURL,
            'ValidationURL' => $validationURL ?: $this->validationURL
        ];
        return $this->sendRequest($body, 'register');
    }
}
