<?php

namespace Samerior\MobileMoney\Mpesa\Library\Core;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
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
     * @var ClientInterface
     */
    public $http_client;
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
     * @throws \Samerior\MobileMoney\Mpesa\Exceptions\MpesaException
     */
    public function __construct(MpesaConfig $mpesaConfig, MpesaCache $mpesaCache, Mpesa $mpesa)
    {
        $this->http_client = new Client(['http_errors' => false,]);
        $this->config = $mpesaConfig;
        $this->cache = $mpesaCache;
        $this->mpesaRepository = $mpesa;
        $this->auth = new Authenticator($this);
    }
}