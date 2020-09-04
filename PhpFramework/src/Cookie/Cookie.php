<?php

namespace PhpFramework\Cookie;

abstract class Cookie
{

    /**
     * Set To Cookies
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function set(string $key, string $value): string
    {
        $expired = time() + (1 * 356 * 24 * 60 * 60);
        setcookie($key, $value, $expired, DS, '', false, true);
        return $value;
    }

    /**
     * Destroy All $_COOKIE
     *
     * @return void
     */
    public static function destroy(): void
    {
        foreach (static::all() as $key => $value) static::remove($key);
    }

    /**
     * Return All $_COOKIE
     * @return array
     */
    public static function all(): array
    {
        return $_COOKIE;
    }

    /**
     * Remove From $_COOKIE By Key
     * @param string $key
     * @return void
     */
    public static function remove(string $key): void
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1, '/');
    }

    /**
     * Get From $_COOKIE Array By Key
     * @param string $key
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return static::has($key) ? $_COOKIE[$key] : null;
    }

    /**
     * Check Is $_COOKIE Has Specific Key
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }
}