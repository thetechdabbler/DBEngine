<?php
namespace Entrata\DBCache\Cache;

interface ICacheEngine {
    public function get($key);
    public function set($key, $value);
    public function delete($key);
}