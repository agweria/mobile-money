<?php

namespace Samerior\MobileMoney\Mpesa\Library\Core;

use GuzzleHttp\Client;
use Samerior\MobileMoney\Mpesa\Library\Auth\Authenticator;
use Samerior\MobileMoney\Mpesa\Repositories\EndpointsRepository;

/**
 * Class Http
 * @package Samerior\MobileMoney\Mpesa\Library\Core
 */
class Http
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['http_errors' => false,]);
    }

    /**
     * @param array $body
     * @param string $endpoint
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \Throwable
     */
    public function makeRequest($body, $endpoint): \Psr\Http\Message\ResponseInterface
    {
        $this->auth = app(Authenticator::class);
        return $this->client->request(
            'POST',
            $endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->auth->authenticate(),
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]
        );
    }

    /**
     * Send request for bearer token
     * @param string $credentials
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     */
    public function authRequest($credentials): \Psr\Http\Message\ResponseInterface
    {
        $endpoint = EndpointsRepository::build('auth');
        return $this->client->get($endpoint, [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
