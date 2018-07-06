<?php

namespace Samerior\MobileMoney\Mpesa\Library\Core;

use Samerior\MobileMoney\Mpesa\Library\Auth\Authenticator;
use Samerior\MobileMoney\Mpesa\Repositories\Mpesa;
use Samerior\MobileMoney\Mpesa\Repositories\MpesaCache;
use Samerior\MobileMoney\Mpesa\Repositories\MpesaConfig;

/**
 * Class Bootstrap
 * @package Samerior\MobileMoney\Mpesa\Library\Core
 */
class Bootstrap
{
    /**
     * @var Http
     */
    public $http;
    /**
     * @var Authenticator
     */
    public $auth;
    /**
     * @var MpesaConfig
     */
    public $config;
    /**
     * @var MpesaCache
     */
    public $cache;
    /**
     * @var Mpesa
     */
    public $mpesaRepository;

    /**
     * Bootstrap constructor.
     * @param MpesaConfig $mpesaConfig
     * @param MpesaCache $mpesaCache
     * @param Mpesa $mpesa
     * @param Http $http
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     */
    public function __construct(MpesaConfig $mpesaConfig, MpesaCache $mpesaCache, Mpesa $mpesa, Http $http)
    {
        $this->http = $http;
        $this->config = $mpesaConfig;
        $this->cache = $mpesaCache;
        $this->mpesaRepository = $mpesa;
        $this->auth = new Authenticator($this);
    }
}