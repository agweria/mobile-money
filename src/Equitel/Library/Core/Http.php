<?php

namespace Samerior\MobileMoney\Equitel\Library\Core;

use GuzzleHttp\Client;

/**
 * Class Http
 * @package Samerior\MobileMoney\Equitel\Library\Core
 */
class Http
{
    /**
     * @var Client
     */
    public $client;
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
}