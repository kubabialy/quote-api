<?php


namespace App\Infrastructure\Cache;


use Redis;

class RedisCacheHandler implements CacheInterface
{
    /** @var int 5 minutes of expiry time */
    private const EXPIRY_TIME_IN_SECONDS = 300;

    /**
     * @var Redis
     */
    private $redis;

    /**
     * QuoteRedisCache constructor.
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getElementByKey(string $key): ?string
    {
        $result = $this->redis->get($key);

        return $result ?: null;
    }

    /**
     * @param string $key
     * @param string $element
     */
    public function setElementWithKey(string $key, string $element): void
    {
        $this->redis->set($key, $element, self::EXPIRY_TIME_IN_SECONDS);
    }
}