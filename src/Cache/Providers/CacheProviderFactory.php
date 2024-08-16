<?php
namespace Entrata\DBCache\Cache\Providers;

use Entrata\DBCache\Cache\DynamoDBProvider;
use Entrata\DBCache\Cache\Providers\ICacheProvider;
use Entrata\DBCache\CacheType;
use Psi\Libraries\Redis\CRedisCluster;

class CacheProviderFactory {
    /**
     * Create an instance of a cache provider based on the provided type.
     * @param string $type The type of cache provider (e.g., 'redis', 'memcached')
     * @param array $config Configuration options for the cache provider
     * @return ICacheProvider
     * @throws \InvalidArgumentException If the cache provider type is not supported
     */
    public static function create(string $type, array $config = []): ICacheProvider
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
    protected static function createRedisProvider(array $config): ICacheProvider
    {
        $redis = CRedisCluster::createService()->getMaster();
            // CRedisCluster::createService()->getMaster();

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
