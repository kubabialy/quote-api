<?php


namespace App\Infrastructure\Cache;


interface CacheInterface
{
    /**
     * Returns single element found in cache or null in case of not found key
     *
     * @param string $key
     * @return string
     */
    public function getElementByKey(string $key): ?string;

    /**
     * Saves element in cache
     *
     * @param string $key
     * @param string $element
     */
    public function setElementWithKey(string $key, string $element): void;
}