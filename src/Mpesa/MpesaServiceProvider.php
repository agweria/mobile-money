<?php

namespace Samerior\MobileMoney\Mpesa;

use Samerior\MobileMoney\Mpesa\Commands\Registra;
use Samerior\MobileMoney\Mpesa\Commands\StkStatus;
use Samerior\MobileMoney\Mpesa\Events\C2bConfirmationEvent;
use Samerior\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent;
use Samerior\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent;
use Samerior\MobileMoney\Mpesa\Http\Middlewares\MobileMoneyCors;
use Samerior\MobileMoney\Mpesa\Library\BulkSender;
use Samerior\MobileMoney\Mpesa\Library\Core;
use Samerior\MobileMoney\Mpesa\Library\IdCheck;
use Samerior\MobileMoney\Mpesa\Library\RegisterUrl;
use Samerior\MobileMoney\Mpesa\Library\StkPush;
use Samerior\MobileMoney\Mpesa\Listeners\C2bPaymentConfirmation;
use Samerior\MobileMoney\Mpesa\Listeners\StkPaymentFailed;
use Samerior\MobileMoney\Mpesa\Listeners\StkPaymentSuccessful;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * Class MpesaServiceProvider
 * @package Samerior\MobileMoney\Mpesa
 */
class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws Exceptions\MpesaException
     */
    public function register()
    {
        $core = new Core(new Client(['http_errors' => false,]));
        $this->app->bind(Core::class, function () use ($core) {
            return $core;
        });
        $this->commands(
            [
                Registra::class,
                StkStatus::class,
            ]
        );

        $this->registerFacades();
        $this->registerEvents();
        $this->mergeConfigFrom(__DIR__ . '/../../config/dervisgroup.mpesa.php', 'dervisgroup.mpesa');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([__DIR__ . '/../../config/dervisgroup.mpesa.php' => config_path('dervisgroup.mpesa.php'),]);

        $this->app['router']->aliasMiddleware('pesa.cors', MobileMoneyCors::class);
    }

    /**
     * Register facade accessors
     */
    private function registerFacades()
    {
        $this->app->bind(
            'mpesa_stk', function () {
                return $this->app->make(StkPush::class);
            }
        );
        $this->app->bind(
            'mpesa_registrar', function () {
                return $this->app->make(RegisterUrl::class);
            }
        );
        $this->app->bind(
            'mpesa_identity', function () {
                return $this->app->make(IdCheck::class);
            }
        );
        $this->app->bind(
            'mpesa_b2c', function () {
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
