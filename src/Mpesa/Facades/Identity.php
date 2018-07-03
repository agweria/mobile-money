<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

/**
 * Class Identity
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class Identity extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::$short_name . 'identity';
    }
}
