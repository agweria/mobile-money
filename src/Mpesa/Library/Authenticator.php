<?php

namespace Samerior\MobileMoney\Mpesa\Library;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;
use Samerior\MobileMoney\Mpesa\Repositories\EndpointsRepository;

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
     * @var Core
     */
    protected $engine;
    /**
     * @var Authenticator
     */
    protected static $instance;
    /**
     * @var bool
     */
    public $alt = false;
    /**
     * @var string
     */
    private $credentials;

    /**
     * Authenticator constructor.
     *
     * @param  Core $core
     * @throws MpesaException
     */
    public function __construct(Core $core)
    {
        $this->engine = $core;
        $this->endpoint = EndpointsRepository::build('auth');
        self::$instance = $this;
    }

    /**
     * @param bool $bulk
     * @return string
     * @throws MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authenticate($bulk = false): ?string
    {
        if ($bulk) {
            $this->alt = true;
        }
        $this->generateCredentials();
        if (config('samerior.mpesa.cache_credentials', false) && !empty($key = $this->getFromCache())) {
            return $key;
        }
        try {
            $response = $this->makeRequest();
            if ($response->getStatusCode() === 200) {
                $body = \json_decode($response->getBody());
                $this->saveCredentials($body);
                return $body->access_token;
            }
            throw new MpesaException($response->getReasonPhrase());
        } catch (RequestException $exception) {
            $message = $exception->getResponse() ?
                $exception->getResponse()->getReasonPhrase() :
                $exception->getMessage();

            throw $this->generateException($message);
        }
    }

    /**
     * @param $reason
     * @return MpesaException
     */
    private function generateException($reason): ?MpesaException
    {
        switch (\strtolower($reason)) {
            case 'bad request: invalid credentials':
                return new MpesaException('Invalid consumer key and secret combination');
            default:
                return new MpesaException($reason);
        }
    }

    /**
     * @return $this
     */
    private function generateCredentials(): self
    {
        $key = \config('samerior.mpesa.c2b.consumer_key');
        $secret = \config('samerior.mpesa.c2b.consumer_secret');
        if ($this->alt) {
            //lazy way to switch to a different app in case of bulk
            $key = \config('samerior.mpesa.bulk.consumer_key');
            $secret = \config('samerior.mpesa.bulk.consumer_secret');
        }
        $this->credentials = \base64_encode($key . ':' . $secret);
        return $this;
    }

    /**
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeRequest(): ResponseInterface
    {
        return $this->engine->client->request(
            'GET', $this->endpoint, [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->credentials,
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    /**
     * @return mixed
     */
    private function getFromCache()
    {
        return Cache::get($this->credentials);
    }

    /**
     * Store the credentials in the cache.
     *
     * @param $credentials
     */
    private function saveCredentials($credentials)
    {
        Cache::put($this->credentials, $credentials->access_token, 30);
    }
}
