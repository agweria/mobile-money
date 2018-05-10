<?php

namespace Samerior\MobileMoney\Mpesa\Library;

use Samerior\MobileMoney\Mpesa\Exceptions\MpesaException;
use Samerior\MobileMoney\Mpesa\Repositories\EndpointsRepository;
use Samerior\MobileMoney\Mpesa\Repositories\Mpesa;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ApiCore
 *
 * @package Samerior\MobileMoney\Mpesa\Library
 */
class ApiCore
{
    /**
     * @var Core
     */
    private $engine;
    /**
     * @var bool
     */
    public $bulk = false;
    /**
     * @var Mpesa
     */
    public $mpesaRepository;

    /**
     * ApiCore constructor.
     *
     * @param Core $engine
     * @param Mpesa $mpesa
     */
    public function __construct(Core $engine, Mpesa $mpesa)
    {
        $this->engine = $engine;
        $this->mpesaRepository = $mpesa;
    }

    /**
     * @param string $number
     * @param bool $strip_plus
     * @return string
     */
    protected function formatPhoneNumber($number, $strip_plus = true): string
    {
        $number = preg_replace('/\s+/', '', $number);
        $replace = function ($needle, $replacement) use (&$number) {
            if (starts_with($number, $needle)) {
                $pos = strpos($number, $needle);
                $length = \strlen($needle);
                $number = substr_replace($number, $replacement, $pos, $length);
            }
        };
        $replace('2547', '+2547');
        $replace('07', '+2547');
        if ($strip_plus) {
            $replace('+254', '254');
        }
        return $number;
    }

    /**
     * @param array $body
     * @param string $endpoint
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeRequest($body, $endpoint)
    {
        return $this->engine->client->request(
            'POST',
            $endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->engine->auth->authenticate($this->bulk),
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]
        );
    }

    /**
     * @param array $body
     * @param string $endpoint
     * @return mixed
     * @throws MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest($body, $endpoint)
    {
        $endpoint = EndpointsRepository::build($endpoint);
        try {
            $response = $this->makeRequest($body, $endpoint);
            $_body = \json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new MpesaException($_body->errorMessage ? $_body->errorCode . ' - ' . $_body->errorMessage : $response->getBody());
            }
            return $_body;
        } catch (ClientException $exception) {
            throw $this->generateException($exception);
        }
    }

    /**
     * @param ClientException $exception
     * @return MpesaException
     */
    private function generateException(ClientException $exception): MpesaException
    {
        return new MpesaException($exception->getResponse()->getBody());
    }
}
