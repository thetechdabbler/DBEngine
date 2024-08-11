<?php
namespace Entrata\DBCache\Cache;

use Entrata\DBCache\Cache\ICacheEngine;

class DynamoDBCache implements ICacheEngine {
    private $client;
    private $table_name;

    public function __construct($client, $table_name) {
        $this->client = $client;
        $this->table_name = $table_name;
    }

    public function get($key) {
        $result = $this->client->getItem([
            'TableName' => $this->table_name,
            'Key' => [
                'key' => ['S' => $key]
            ]
        ]);
        if (isset($result['Item'])) {
            return $result['Item']['value']['S'];
        }
        return null;
    }

    public function set($key, $value) {
        $this->client->putItem([
            'TableName' => $this->table_name,
            'Item' => [
                'key' => ['S' => $key],
                'value' => ['S' => $value]
            ]
        ]);
    }

    public function delete($key) {
        $this->client->deleteItem([
            'TableName' => $this->table_name,
            'Key' => [
                'key' => ['S' => $key]
            ]
        ]);
    }
}