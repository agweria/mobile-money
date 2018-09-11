<?php

namespace Samerior\MobileMoney\Equitel;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Samerior\MobileMoney\Equitel\Library\B2C\CreatePayment;

/**
 * Class EquitelServiceProvider
 * @package Samerior\MobileMoney\Equitel
 */
class EquitelServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private $short_name = 'samerior.mobile-money.equitel.';

    public function register()
    {
        $this->registerFacades();

        $this->mergeConfigFrom(__DIR__ . '/../../config/samerior.equitel.php', 'samerior.equitel');
    }

    private function registerFacades()
    {
        $this->app->bind('samerior.equitel', function (Application $app) {
            return $app->make(CreatePayment::class);
        });
    }
}
