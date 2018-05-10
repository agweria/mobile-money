<?php

namespace Samerior\MobileMoney\Equity;

use Samerior\MobileMoney\Equity\Library\StkRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class EquityServiceProvider
 * @package Samerior\MobileMoney\Equity
 */
class EquityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('equity', function (Application $app) {
            return $app->make(StkRequest::class);
        });
    }
}
