<?php

namespace Samerior\MobileMoney\Mpesa;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Samerior\MobileMoney\Mpesa\Commands\Registra;
use Samerior\MobileMoney\Mpesa\Commands\StkStatus;
use Samerior\MobileMoney\Mpesa\Events\C2bConfirmationEvent;
use Samerior\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent;
use Samerior\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent;
use Samerior\MobileMoney\Mpesa\Http\Middlewares\MobileMoneyCors;
use Samerior\MobileMoney\Mpesa\Library\BulkSender;
use Samerior\MobileMoney\Mpesa\Library\C2B\RegisterUrl;
use Samerior\MobileMoney\Mpesa\Library\C2B\StkPush;
use Samerior\MobileMoney\Mpesa\Library\IdCheck;
use Samerior\MobileMoney\Mpesa\Listeners\C2bPaymentConfirmation;
use Samerior\MobileMoney\Mpesa\Listeners\StkPaymentFailed;
use Samerior\MobileMoney\Mpesa\Listeners\StkPaymentSuccessful;

/**
 * Class MpesaServiceProvider
 * @package Samerior\MobileMoney\Mpesa
 */
class MpesaServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private $short_name = 'samerior.mobile-money.mpesa.';

    /**
     * Register the service provider.
     *
     * @return void
     * @throws Exceptions\MpesaException
     */
    public function register()
    {
//        $this->app->bind(Bootstrap::class, function ($app) {
//            return $app->make(Bootstrap::class);
//        });
        $this->commands(
            [
                Registra::class,
                StkStatus::class,
            ]
        );

        $this->registerFacades();
        $this->registerEvents();
        $this->mergeConfigFrom(__DIR__ . '/../../config/samerior.mpesa.php', 'samerior.mpesa');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([__DIR__ . '/../../config/samerior.mpesa.php' => config_path('samerior.mpesa.php'),]);

        $this->app['router']->aliasMiddleware('pesa.cors', MobileMoneyCors::class);
    }

    /**
     * Register facade accessors
     */
    private function registerFacades()
    {
        $this->app->bind(
            $this->short_name . 'stk', function () {
                return $this->app->make(StkPush::class);
            }
        );
        $this->app->bind(
            $this->short_name . 'registrar', function () {
                return $this->app->make(RegisterUrl::class);
            }
        );
        $this->app->bind(
            $this->short_name . 'identity', function () {
                return $this->app->make(IdCheck::class);
            }
        );
        $this->app->bind(
            $this->short_name . 'b2c', function () {
                return $this->app->make(BulkSender::class);
            }
        );
    }

    /**
     * Register events
     */
    private function registerEvents()
    {
        Event::listen(StkPushPaymentSuccessEvent::class, StkPaymentSuccessful::class);
        Event::listen(StkPushPaymentFailedEvent::class, StkPaymentFailed::class);
        Event::listen(C2bConfirmationEvent::class, C2bPaymentConfirmation::class);
    }
}
