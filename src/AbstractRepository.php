<?php
namespace Entrata\DBCache;

use Entrata\DBCache\Cache\ICacheEngine;
use Entrata\DBCache\Cache\RedisCache;
use Entrata\DBCache\Cache\DynamoDBCache;
use Entrata\DBCache\Cache\IDataset;
/**
 * AbstractRepository class
 *
 * This class serves as the base class for all repository classes in the DBEngine project.
 * It provides common functionality and methods that can be used by child repository classes.
 * Child classes should extend this class and implement their specific repository logic.
 *
 * @package DBEngine
 * @subpackage Repository
 */
use Entrata\DBCache\Cache\IRepository;

abstract class AbstractRepository {
    private $cacheEngine;
    private $dataset;

    public function __construct() {
        $this->cacheEngine = $this->getCacheEngine();
        $this->dataset = $this->getDataset();
    }

    /**
     * Retrieves data from the cache engine if available, otherwise retrieves it from the dataset and stores it in the cache engine.
     *
     * @param mixed $key The key used to retrieve the data.
     * @return mixed The retrieved data.
     */
    public function get($key) {
        $data = $this->cacheEngine->get($key);
        if ($data === null) {
            $this->cacheEngine->set($key, $data);
        }

        $this->mapToDataset($data);
        return $this->dataset->get();
    }

    public function mapToDataset($data)  {
        return $this->dataset->setData($data);
    }

    /**
     * Stores data in the cache engine.
     *
     * @param mixed $key The key used to store the data.
     * @param mixed $value The data to be stored.
     * @return void
     */
    public function set($key, $value) {
        $this->cacheEngine->set($key, $value);
    }

    /**
     * Deletes data from the cache engine.
     *
     * @param mixed $key The key used to delete the data.
     * @return void
     */
    public function delete($key) {
        $this->cacheEngine->delete($key);
    }
    /**
     * Retrieves the cache engine used by the repository.
     *
     * @return ICacheEngine The cache engine instance.
     */
    abstract public function getCacheEngine(): ICacheEngine;

    /**
     * Retrieves the dataset used by the repository.
     *
     * @return IDataset The dataset instance.
     */
    abstract public function getDataset(): IDataset;

    

   

    
}