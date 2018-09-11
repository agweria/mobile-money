<?php

namespace Samerior\MobileMoney\Equitel\Repositories;

use Illuminate\Cache\Repository;

/**
 * Class EquitelCache
 * @package Samerior\MobileMoney\Equitel\Repositories
 */
class EquitelCache
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
     * MpesaCache constructor.
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
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->repository->get($this->short_name . '.' . $key, $default);
    }

    /**
     * Store an item in the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param \DateTimeInterface|\DateInterval|float|int $minutes
     */
    public function put($key, $value, $minutes = null): void
    {
        $this->repository->put($this->short_name . '.' . $key, $value, $minutes);
    }
}
