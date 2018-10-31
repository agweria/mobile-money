<?php

namespace Samerior\MobileMoney\Mpesa\Repositories;

use Samerior\MobileMoney\Mpesa\Commands\AddApp as Console;
use Samerior\MobileMoney\Mpesa\Database\Entities\MpesaApp;

/**
 * Class MpesaApps
 * @package Samerior\MobileMoney\Mpesa\Repositories
 */
class MpesaApps
{
    /**
     * @var Console
     */
    private $console;
    /**
     * @var string
     */
    private $mode;

    private function promptEnvironment()
    {
        $this->mode = $this->console->anticipate('Specify mode', ['production', 'sandbox'], 'sandbox');
        return $this->mode;
    }

    /**
     * @param Console $console
     * @return MpesaApps
     */
    public function setConsole(Console $console): MpesaApps
    {
        $this->console = $console;
        return $this;
    }

    /**
     * @param $field
     * @param bool $nullable
     * @return mixed
     */
    private function prompt($field, $nullable = false)
    {
        $answer = $this->console->ask('Enter the ' . $field);
        if (!empty($answer) || $nullable) {
            return $answer;
        }
        $this->console->error($field . ' cannot be null');
        return $this->prompt($field);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|MpesaApp
     */
    public function addNewApp()
    {
        $mode = $this->promptEnvironment();
        $name = $this->promptAppName();
        $type = $this->console->askWithCompletion('Which type of shortcode is this',
            ['C2B', 'B2C', 'B2B', 'c2b', 'b2c', 'b2b'], 'C2B');
        $this->console->warn('App details');
        $app = [
            'environment' => $mode,
            'name' => $name,
            'short_code' => $this->prompt('Short Code / Paybill /Till NUmber'),
            'consumer_key' => $this->prompt('Consumer key'),
            'consumer_secret' => $this->prompt('Consumer secret'),
            'passkey' => $this->prompt('Passkey', true),
            'type' => $type,
            'initiator_name' => $this->prompt('Initiator Name'),
            'initiator_credentials' => $this->prompt('Initiator Credentials'),
        ];
        return MpesaApp::create($app);
    }

    private function promptAppName()
    {
        $default = ucwords($this->mode) . 'App-' . time();
        return $this->console->ask('App name <question>(From developer portal)</question>', $default);
    }
}
