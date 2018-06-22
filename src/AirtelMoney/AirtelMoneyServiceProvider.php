<?php

namespace Samerior\MobileMoney\AirtelMoney;


use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Samerior\MobileMoney\AirtelMoney\Library\Cashier;

/**
 * Class AirtelMoneyServiceProvider
 * @package Samerior\MobileMoney\AirtelMoney
 */
class AirtelMoneyServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->app->bind('airtel_money', function (Application $app) {
            return $app->make(Cashier::class);
        });
    }

}