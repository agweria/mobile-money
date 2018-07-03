<?php

namespace Samerior\MobileMoney\Mpesa\Repositories;

use Illuminate\Config\Repository;


/**
 * Class MpesaConfig
 * @package Samerior\MobileMoney\Mpesa\Repositories
 */
class MpesaConfig
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var string
     */
    private $short_name = 'samerior.mpesa';

    /**
     * MpesaConfig constructor.
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get given config value from the configuration store.
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->repository->get($this->short_name . '.' . $key, $default);
    }
}