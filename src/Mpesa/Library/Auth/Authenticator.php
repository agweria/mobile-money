<?php

namespace Samerior\MobileMoney\Mpesa\Library\Auth;

use GuzzleHttp\Exception\RequestException;
use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use Samerior\MobileMoney\Mpesa\Library\Core\Bootstrap;
use Throwable;

/**
 * Class Authenticator
 *
 * @package Samerior\MobileMoney\Mpesa\Library
 */
class Authenticator
{

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var Bootstrap
     */
    protected $core;
    /**
     * @var Authenticator
     */
    protected static $instance;

    /**
     * Authenticator constructor.
     * @param Bootstrap $core
     */
    public function __construct(Bootstrap $core)
    {
        $this->core = $core;
    }

    /**
     * Acquire authentication
     * @return string
     * @throws MpesaException
     * @throws Throwable
     */
    public function authenticate(): ?string
    {
        $credentials = $this->generateCredentials();
        if ($this->core->config->get('cache_credentials', false) && !empty($key = $this->getFromCache($credentials))) {
            return $key;
        }
        try {
            $response = $this->core->http->authRequest($credentials);
            throw_unless($response->getStatusCode() === 200, MpesaException::class, $response->getReasonPhrase());
            $body = \json_decode($response->getBody());
            $this->saveCredentials($body);
            return $body->access_token;
        } catch (RequestException $exception) {
            $message = $exception->getResponse() ?
                $exception->getResponse()->getReasonPhrase() :
                $exception->getMessage();
            throw  new  MpesaException($message);
        }
    }

    /**
     * Generate base64 encoded consumer key and secret for obtaining bearer
     * @return string
     */
    private function generateCredentials(): string
    {
        $key = $this->core->config->get('c2b.consumer_key');
        $secret = $this->core->config->get('c2b.consumer_secret');
        return \base64_encode($key . ':' . $secret);
    }
    /**
     * Retrieve this app's credentials from our cache store
     * @param string|null $credentials
     * @return string|null
     */
    private function getFromCache($credentials): ?string
    {
        return $this->core->cache->get($credentials);
    }

    /**
     * Store the credentials in the cache.
     *
     * @param $credentials
     * @return null|string
     */
    private function saveCredentials($credentials): ?string
    {
        $this->core->cache->put($credentials, $credentials->access_token, 30);
        return $this->getFromCache($credentials);
    }
}
