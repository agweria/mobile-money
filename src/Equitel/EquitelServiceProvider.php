<?php

namespace Samerior\MobileMoney\Equitel;

use Samerior\MobileMoney\Equitel\Library\StkRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class EquitelServiceProvider
 * @package Samerior\MobileMoney\Equitel
 */
class EquitelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('samerior.equitel', function (Application $app) {
            return $app->make(StkRequest::class);
        });
        $this->mergeConfigFrom(__DIR__ . '/../../config/samerior.equitel.php', 'samerior.equitel');
    }
}
