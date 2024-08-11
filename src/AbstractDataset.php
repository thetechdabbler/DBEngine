<?php
namespace Entrata\DBCache;

use Entrata\DBCache\Cache\Strategies\ICacheStrategy;
use Entrata\DBCache\Cache\ICacheEngine;

abstract class AbstractDataset implements \Entrata\DBCache\Cache\IDataset {
    private $cacheStrategy;
    private $data;

    public function __construct(ICacheStrategy $cacheStrategy) {
        $this->cacheStrategy = $cacheStrategy;
        $this->cacheStrategy->setDataset($this);
    }

    public function get() {
        return $this->data;
    }

    public function set($key, $value) {
        $this->cacheStrategy->set($key, $value);
    }

    public function delete($key) {
        $this->cacheStrategy->delete($key);
    }
}