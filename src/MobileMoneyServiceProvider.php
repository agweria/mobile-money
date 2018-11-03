<?php

namespace Samerior\MobileMoney;

use Samerior\MobileMoney\AirtelMoney\AirtelMoneyServiceProvider;
use Samerior\MobileMoney\Equitel\EquitelServiceProvider;
use Samerior\MobileMoney\Mpesa\Http\Middlewares\MobileMoneyCors;
use Samerior\MobileMoney\Mpesa\MpesaServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class MobileMoneyServiceProvider
 * @package Samerior\MobileMoney
 */
class MobileMoneyServiceProvider extends ServiceProvider
{
    private $_providers = [
        'mpesa' => MpesaServiceProvider::class,
        'equitel' => EquitelServiceProvider::class,
        'airtel' => AirtelMoneyServiceProvider::class,
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/samerior.config.php', 'samerior.config');
        $this->registerAdditionalProviders();
    }

    private function registerAdditionalProviders()
    {
        $enabled = config('samerior.config.enabled_providers');
        foreach ($enabled as $_item) {
            $this->app->register($this->_providers[$_item]);
        }
    }

    /**
     * Boot
     */
    public function boot()
    {
        $this->requireHelperScripts();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'payments');
        $this->app['router']->aliasMiddleware('pesa.cors', MobileMoneyCors::class);
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/samerior.config.php' => config_path('samerior.config.php'),]);
        }
    }

    /**
     * Load helper file in Support Directory
     */
    private function requireHelperScripts()
    {
        $files = glob(__DIR__ . '/Support/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}
