<?php

namespace Samerior\MobileMoney\Equitel\Repositories;

use Illuminate\Config\Repository;

/**
 * Class EquitelConfig
 * @package Samerior\MobileMoney\Equitel\Repositories
 */
class EquitelConfig
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var string
     */
    private $short_name = 'samerior.equitel';

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