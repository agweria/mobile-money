<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

/**
 * Class B2C
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class B2C extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::$short_name . 'b2c';
    }
}
