<?php

namespace Samerior\MobileMoney\Equitel\Library\Core;

use Samerior\MobileMoney\Equitel\Repositories\EquitelCache;
use Samerior\MobileMoney\Equitel\Repositories\EquitelConfig;
use Samerior\MobileMoney\Equitel\Repositories\EquitelRepository;

/**
 * Class Bootstrap
 * @package Samerior\MobileMoney\Equitel\Library
 */
class Bootstrap
{
    /**
     * @var Http
     */
    public $http;
    public $auth;
    /**
     * @var EquitelConfig
     */
    public $config;
    /**
     * @var EquitelCache
     */
    public $cache;
    /**
     * @var EquitelRepository
     */
    public $repository;

    /**
     * Bootstrap constructor.
     * @param Http $http
     * @param EquitelRepository $repository
     * @param EquitelConfig $config
     * @param EquitelCache $cache
     */
    public function __construct(Http $http, EquitelRepository $repository, EquitelConfig $config, EquitelCache $cache)
    {
        $this->http = $http;
        $this->config = $config;
        $this->cache = $cache;
        $this->repository = $repository;
//        $this->auth = new Authenticator($this);
    }
}