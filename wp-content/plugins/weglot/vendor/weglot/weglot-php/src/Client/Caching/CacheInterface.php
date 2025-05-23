<?php

namespace Weglot\Client\Caching;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

interface CacheInterface
{
    /**
     * @param CacheItemPoolInterface|null $cacheItemPool
     *
     * @return $this
     */
    public function setItemPool($cacheItemPool);

    /**
     * @return CacheItemPoolInterface
     */
    public function getItemPool();

    /**
     * @param int $cacheExpire Time in seconds before expire, default is 86400
     *
     * @return $this
     */
    public function setExpire($cacheExpire);

    /**
     * @return int
     */
    public function getExpire();

    /**
     * Check if cache is enabled.
     *
     * @return bool
     */
    public function enabled();

    /**
     * Generate cache key based on sha1 hash.
     *
     * @param array<mixed> $array Body content of the request as array
     *
     * @return string
     */
    public function generateKey(array $array);

    /**
     * @param string $key
     *
     * @return CacheItemInterface
     */
    public function get($key);

    /**
     * Mix of generateKey & get functions.
     *
     * @param array<mixed> $data
     *
     * @return CacheItemInterface
     */
    public function getWithGenerate(array $data);

    /**
     * @return bool
     */
    public function save(CacheItemInterface $item);
}
