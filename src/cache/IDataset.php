<?php
namespace Entrata\DBCache\Cache;

interface IDataset {
    public function toArray();

    public function setData($data);

    public function get();
}