<?php

namespace Samerior\MobileMoney\Equitel\Repositories;

use Samerior\MobileMoney\Equitel\Exceptions\EquitelException;

/**
 * Class Endpoints
 * @package Samerior\MobileMoney\Equitel\Repositories
 */
class Endpoints
{
    /**
     * @param $section
     * @return string
     * @throws EquitelException
     */
    private static function getEndpoint($section): string
    {
        $list = [
            'create_payment' => 'transaction-sandbox/v1-sandbox/payments',
        ];
        if ($item = $list[$section]) {
            return self::getUrl($item);
        }
        throw new EquitelException('Unknown endpoint');
    }

    /**
     * @param string $suffix
     * @return string
     */
    private static function getUrl($suffix): string
    {
        $baseEndpoint = 'https://api.equitybankgroup.com/';
        if (\config('samerior.equitel.sandbox')) {
            $baseEndpoint = 'https://api.equitybankgroup.com/';
        }
        return $baseEndpoint . $suffix;
    }

    /**
     * @param $endpoint
     * @return string
     * @throws \Exception
     */
    public static function build($endpoint): string
    {
        return self::getEndpoint($endpoint);
    }


}