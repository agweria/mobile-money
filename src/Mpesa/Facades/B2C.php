<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class B2C
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class B2C extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpesa_b2c';
    }
}
