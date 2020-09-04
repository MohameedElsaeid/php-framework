<?php

namespace PhpFramework\Session;


/**
 * Class Session
 * @package PhpFramework\Session
 */
class Session
{

    /**
     * Session constructor.
     */
    private function __construct()
    {
    }

    /**
     * Start Sessions
     * @return void;
     */
    public static function start(): void
    {
        if (!session_id()) {
            ini_set('session.use_only_cookies', 1);
            session_start();
        }
    }

    /**
     * Set Key To Value In Session
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function set(string $key, string $value): string
    {
        $_SESSION[$key] = $value;
        return $value;
    }

    /**
     * Destroy All Sessions
     *
     * @return void
     */
    public static function destroy(): void
    {
        foreach (static::all() as $key => $value) static::remove($key);
    }

    /**
     * Return All Sessions
     * @return array
     */
    public static function all(): array
    {
        return $_SESSION;
    }

    /**
     * Remove From Session By Key
     * @param string $key
     * @return void
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return string|null
     */
    public static function flash(string $key): ?string
    {
        $value = null;

        if (static::has($key)) {
            $value = static::get($key);
            static::remove($key);
        }
        return $value;
    }

    /**
     * Check Is Session Has Specific Key
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get From Sessions Array By Key
     * @param string $key
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return static::has($key) ? $_SESSION[$key] : null;
    }
}