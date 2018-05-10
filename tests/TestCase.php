<?php

namespace Samerior\MobileMoney\Tests;

use Samerior\MobileMoney\Mpesa\Facades\B2C;
use Samerior\MobileMoney\Mpesa\Facades\Identity;
use Samerior\MobileMoney\Mpesa\Facades\Registrar;
use Samerior\MobileMoney\Mpesa\Facades\STK;
use Samerior\MobileMoney\MobileMoneyServiceProvider;

/**
 * Class TestCase
 * @package Samerior\MobileMoney\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [MobileMoneyServiceProvider::class];
    }

    protected function getPackdageAliases($app)
    {
        return [
            'B2C' => B2C::class,
            'Identity' => Identity::class,
            'Registrar' => Registrar::class,
            'STK' => STK::class,
        ];
    }
}
