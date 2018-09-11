<?php

namespace Samerior\MobileMoney\Equitel\Library\Core;

use Samerior\MobileMoney\Equitel\Exceptions\EquitelException;
use Samerior\MobileMoney\Equitel\Repositories\Endpoints;

/**
 * Class ApiCore
 * @package Samerior\MobileMoney\Equitel\Library\Core
 */
class ApiCore
{
    /**
     * @var Bootstrap
     */
    protected $core;

    /**
     * ApiCore constructor.
     * @param Bootstrap $engine
     */
    public function __construct(Bootstrap $engine)
    {
        $this->core = $engine;
    }

    /**
     * Attempt to format the phone number to begin with 2547xxxxxxxxx
     * @param string $number
     * @param bool $strip_plus
     * @return string
     * @throws \Throwable
     */
    protected function formatPhoneNumber($number, $strip_plus = true): string
    {
        $number = preg_replace('/\s+/', '', $number);
        /**
         * Closure to replace the first occurrence, [if it exists?] with a new set of string
         * @param $needle
         * @param $replacement
         */
        $replace = function ($needle, $replacement) use (&$number) {
            if (starts_with($number, $needle)) {
                $pos = strpos($number, $needle);
                $length = \strlen($needle);
                $number = substr_replace($number, $replacement, $pos, $length);
            }
        };
        $replace('2547', '+2547');
        $replace('07', '+2547');
        $replace('7', '+2547');
        if ($strip_plus) {
            $replace('+254', '254');
        }
        throw_unless(\strlen($number) === 12, EquitelException::class, 'Invalid Phone number');
        return $number;
    }

    /**
     * @param array $body
     * @param string $endpoint
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     * @throws \Throwable
     */
    public function sendRequest($body, $endpoint)
    {
        $endpoint = Endpoints::build($endpoint);
        return $this->core->http->makeRequest($body, $endpoint);
    }
}
