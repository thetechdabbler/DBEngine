<?php

namespace Entrata\DBCache\Cache;

use Entrata\DBCache\Cache\ICacheEngine;

class RedisCache implements ICacheEngine {
    public function delete($key) {
        $this->redis->del($key);
    }
    private $redis;

    public function __construct($redis) {
        $this->redis = $redis;
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function set($key, $value) {
        $this->redis->set($key, $value);
    }

}
