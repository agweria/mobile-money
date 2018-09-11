<?php

namespace Samerior\MobileMoney\Equitel\Library\Identity;

use Samerior\MobileMoney\Equitel\Library\Core\Bootstrap;
use Samerior\MobileMoney\Equitel\Repositories\Endpoints;

/**
 * Class AccessToken
 * @package Samerior\MobileMoney\Equitel\Library\Identity
 */
class AccessToken
{
    /**
     * @var Bootstrap
     */
    private $core;

    /**
     * Identity constructor.
     * @param Bootstrap $instance
     */
    public function __construct(Bootstrap $instance)
    {
        $this->core = $instance;
    }

    /**
     * @return null|string
     * @throws \Exception
     */
    public function authenticate(): ?string
    {
        $credentials = $this->generateCredentials();
        $body = [
            'username' => $this->core->config->get('username'),
            'password' => $this->core->config->get('password'),
            'grant_type' => 'password'
        ];
        $endpoint = Endpoints::build('access_token');
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $credentials,
            ], 'form_params' => $body
        ];
       return $this->core->http->client->post($endpoint, $options);
    }

    /**
     * Generate base64 encoded consumer key and secret for obtaining bearer
     * @return string
     */
    private function generateCredentials(): string
    {
        $key = $this->core->config->get('consumer_key');
        $secret = $this->core->config->get('consumer_secret');
        return \base64_encode($key . ':' . $secret);
    }
}