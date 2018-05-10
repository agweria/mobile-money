<?php

namespace Samerior\MobileMoney\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Registrar
 * @package Samerior\MobileMoney\Mpesa\Facades
 */
class Registrar extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpesa_registrar';
    }
}
