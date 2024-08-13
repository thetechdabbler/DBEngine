<?php
namespace Entrata\DBCache\Cache\Providers;

use Entrata\DBCache\Cache\DynamoDBProvider;
use Entrata\DBCache\Cache\Providers\ICacheProvider;
use Entrata\DBCache\CacheType;

class CacheProviderFactory {
    /**
     * Create an instance of a cache provider based on the provided type.
     *
     * @param string $type The type of cache provider (e.g., 'redis', 'memcached')
     * @param array $config Configuration options for the cache provider
     * @return CacheProvider
     * @throws \InvalidArgumentException If the cache provider type is not supported
     */
    public static function create(string $type, array $config = []): CacheProvider
    {
        switch (strtolower($type)) {
            case CacheType::REDIS:
                return self::createRedisProvider($config);

            case CacheType::DYNAMODB:
                return self::createDynamoDBProvider($config);

            default:
                throw new \InvalidArgumentException("Unsupported cache provider type: {$type}");
        }
    }

    /**
     * Create a Redis cache provider instance.
     *
     * @param array $config
     * @return CacheProvider
     */
    protected static function createRedisProvider(array $config): CacheProvider
    {
        $redis = new Redis();
        $redis->connect($config['host'] ?? '127.0.0.1', $config['port'] ?? 6379);
        
        return new RedisCacheProvider($redis);
    }

    /**
     * Create a DynamoDB cache provider instance.
     *
     * @param array $config
     * @return CacheProvider
     */
    protected static function createDynamoDBProvider(array $config): CacheProvider
    {
        // Placeholder for creating a DynamoDBCacheProvider
        // This assumes a DynamoDB client is set up correctly with the given config
        $dynamoDbClient = new \Aws\DynamoDb\DynamoDbClient($config);
        
        return new DynamoDBProvider($dynamoDbClient);
    }
}