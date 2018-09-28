<?php

namespace Samerior\MobileMoney\Mpesa\Repositories;

use Samerior\MobileMoney\Mpesa\Commands\AddApp as Console;

/**
 * Class MpesaApps
 * @package Samerior\MobileMoney\Mpesa\Repositories
 */
class MpesaApps
{
    private $console:Console;

    private function promptSandbox()
    {

    }

    public function addNewApp(Console $command)
    {
        dd($command);
    }
}