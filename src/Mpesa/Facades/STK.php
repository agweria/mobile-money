<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

/**
 * Class STK
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class STK extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return self::$short_name . 'stk';
    }
}
