<?php
namespace Entrata\DBCache\Cache\Strategies;

class WriteThroughCache implements \Entrata\DBCache\Cache\Strategies\ICacheStrategy {
    private $cache;
    private $dataset;

    public function __construct(\Entrata\DBCache\Cache\ICacheEngine $cache) {
        $this->cache = $cache;
    }

    public function get($key) {
        $value = $this->cache->get($key);
        if ($value === null) {
            $value = $this->dataset->get($key);
            $this->cache->set($key, $value);
        }
        return $value;
    }

    public function set($key, $value) {
        $this->cache->set($key, $value);
    }

    public function delete($key) {
        $this->cache->delete($key);
    }

    public function setDataset(\Entrata\DBCache\Cache\IDataset $dataset) {
        $this->dataset = $dataset;
    }
}