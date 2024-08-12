<?php

namespace Entrata\DBCache\Cache\Providers;

interface ICacheProvider
{
    /**
     * Retrieve an item from the cache by its key.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * Store an item in the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time to live in seconds
     * @return void
     */
    public function set(string $key, $value, int $ttl = 0);

    /**
     * Invalidate an item in the cache.
     *
     * @param string $key
     * @return void
     */
    public function delete(string $key);

    /**
     * Clear all items from the cache.
     *
     * @return void
     */
    public function clear();
}

interface CacheProvider
{
    /**
     * Retrieve an item from the cache by its key.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * Store an item in the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time to live in seconds
     * @return void
     */
    public function set(string $key, $value, int $ttl = 0);

    /**
     * Invalidate an item in the cache.
     *
     * @param string $key
     * @return void
     */
    public function delete(string $key);

    /**
     * Clear all items from the cache.
     *
     * @return void
     */
    public function clear();
}