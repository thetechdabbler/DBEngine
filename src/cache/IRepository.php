<?php

namespace App\Repository;

interface Repository
{
    /**
     * Fetch data by a given key.
     *
     * @param string $key
     * @return mixed
     */
    public function fetchByKey(string $key);

    /**
     * Store data in the cache for the given key.
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function storeInCache(string $key, $data);

    /**
     * Invalidate cache for the given key.
     *
     * @param string $key
     * @return void
     */
    public function invalidateCache(string $key);

    /**
     * Fetch data directly from the database and update the cache.
     *
     * @param string $key
     * @return mixed
     */
    public function fetchFromDatabase(string $key);
}