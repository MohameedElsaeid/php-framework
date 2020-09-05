<?php


namespace PhpFramework\Http;


/**
 * Class Request
 * @package PhpFramework\Http
 */
abstract class Request
{
    /**
     * @var string|null
     */
    private static ?string $scriptName;
    /**
     * @var string
     */
    private static string $baseUrl;
    /**
     * @var string
     */
    private static string $url;
    /**
     * @var string
     */
    private static string $fullUrl;
    /**
     * @var string
     */
    private static string $queryString;


    /**
     *
     */
    public static function handle(): void
    {
        static::setScriptName();
        static::setBaseUrl();
        static::setUrl();
    }

    /**
     */
    private static function setBaseUrl(): void
    {
        $protocol = Server::get('REQUEST_SCHEME') . '://';
        $host = Server::get('HTTP_HOST');
        $scriptName = static::getScriptName();
        static::$baseUrl = $protocol . $host . $scriptName;
    }

    /**
     * @return string
     */
    public static function getScriptName(): string
    {
        return static::$scriptName;
    }

    /**
     */
    public static function setScriptName(): void
    {
        static::$scriptName = str_replace('\\', '', dirname(Server::get('SCRIPT_NAME')));
    }

    /**
     */
    private static function setUrl(): void
    {
        $requestUri = urldecode(Server::get('REQUEST_URI'));
        $requestUri = rtrim(preg_replace('#^' . static::getScriptName() . '#', '', $requestUri), '/');
        static::$fullUrl = $requestUri;
        $queryString = '';
        if (strpos($requestUri, '?') !== false) {
            [$requestUri, $queryString] = explode('?', $requestUri);
        }

        static::$url = $requestUri ?: '/';
        static::$queryString = $queryString;
    }

    /**
     * @return string
     */
    public static function baseUrl(): string
    {
        return static::$baseUrl;
    }

    /**
     * @return string
     */
    public static function url(): string
    {
        return static::$url;
    }

    /**
     * @return string
     */
    public static function queryString(): string
    {
        return static::$queryString;
    }

    /**
     * @return string
     */
    public static function fullUrl(): string
    {
        return static::$fullUrl;
    }

    /**
     * @return string|null
     */
    public static function method(): ?string
    {
        return Server::get('REQUEST_METHOD');
    }


    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        return static::value($key, $_GET);
    }

    /**
     * @param            $key
     * @param array|null $type
     * @return mixed|null
     */
    public static function value($key, array $type = null)
    {
        $type = $type ?? $_REQUEST;
        return static::has($key, $type) ? $type[$key] : null;
    }

    /**
     * @param $key
     * @param $type
     * @return bool
     */
    public static function has($key, $type): bool
    {
        return array_key_exists($key, $type);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function post(string $key)
    {
        return static::value($key, $_POST);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        $_REQUEST[$key] = $value;
        $_POST[$key] = $value;
        $_GET[$key] = $value;
        return $value;
    }

    /**
     * @return string|null
     */
    public static function previous(): ?string
    {
        return Server::get('HTTP_REFERER');
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        return $_REQUEST;
    }
}