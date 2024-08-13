<?php
namespace Entrata\DBCache\Cache\Providers;

use Entrata\DBCache\Cache\Providers\ICacheProvider;

class DynamoDBProvider implements ICacheProvider {


    private $client;
    private $table_name;

    public function __construct($client) {
        $this->client = $client;
        //$this->table_name = $table_name;
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

    public function set($key, $value, $ttl = 0) {
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

    public function clear() {
        // Implement the clear method logic here
    }
}