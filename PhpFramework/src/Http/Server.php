<?php

namespace PhpFramework\Http;

/**
 * Class Server
 * @package PhpFramework\Http
 */
abstract class Server
{
    /**
     * return All Server Information
     * @return array
     */
    public static function all(): array
    {
        return $_SERVER;
    }

    /**
     * Return Value From Server By Key
     * @param string $key
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return static::has($key) ? $_SERVER[$key] : null;
    }

    /**
     * Check If Server Has Specific Key
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset($_SERVER[$key]);
    }

    /**
     * Server Path Information
     * @param string $path
     * @return array
     */
    public static function path_info(string $path): array
    {
        return pathinfo($path);
    }
}