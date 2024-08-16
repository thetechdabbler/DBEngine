<?php

namespace Entrata\DBCache\Cache\Providers;

use Redis;

class RedisCacheProvider implements ICacheProvider
{
    protected $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;

    }

    public function get(string $key)
    {
        return $this->redis->get($key);
    }

    public function set(string $key, $value, int $ttl = 1000)
    {
        $this->redis->set($key, $value, $ttl);
    }

    public function delete(string $key)
    {
        $this->redis->del($key);
    }

    public function clear()
    {
        $this->redis->flushAll();
    }
}
