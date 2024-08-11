<?php
namespace Entrata\DBCache\Cache\Strategies;

interface ICacheStrategy {
    public function get($key);
    public function set($key, $value);
    public function delete($key);

    public function setDataset(\Entrata\DBCache\Cache\IDataset $dataset);
}