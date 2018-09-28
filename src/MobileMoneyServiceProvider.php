<?php

namespace Samerior\MobileMoney;

use Samerior\MobileMoney\Equitel\EquitelServiceProvider;
use Samerior\MobileMoney\Mpesa\Http\Middlewares\MobileMoneyCors;
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
        $this->app->register(EquitelServiceProvider::class);
    }

    public function boot()
    {
        $this->requireHelperScripts();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'payments');
        $this->app['router']->aliasMiddleware('pesa.cors', MobileMoneyCors::class);
    }

    private function requireHelperScripts()
    {
        $files = glob(__DIR__ . '/Support/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}
