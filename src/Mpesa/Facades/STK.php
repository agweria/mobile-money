<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class STK
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class STK extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mpesa_stk';
    }
}
