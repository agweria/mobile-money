<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

/**
 * Class Registrar
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class Registrar extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::$short_name . 'registrar';
    }
}
