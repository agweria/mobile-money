<?php

namespace Samerior\MobileMoney;

use Samerior\MobileMoney\Equity\EquityServiceProvider;
use Samerior\MobileMoney\Mpesa\MpesaServiceProvider;
use Illuminate\Support\ServiceProvider;

class MobileMoneyServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MpesaServiceProvider::class);
        $this->app->register(EquityServiceProvider::class);
    }

    public function boot()
    {
        $this->requireHelperScripts();
    }

    private function requireHelperScripts()
    {
        $files = glob(__DIR__ . '/Support/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}
