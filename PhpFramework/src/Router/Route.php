<?php


namespace PhpFramework\Router;


use BadFunctionCallException;

class Route
{
    private static array $routes = [];
    private static string $middleware = '';
    private static string $prefix = '';


    public static function get($uri, $callback)
    {
        static::add('GET', $uri, $callback);
    }

    private static function add($methods, $uri, $callback)
    {
        $uri = rtrim(static::$prefix . '/' . trim($uri, '/'), '/');
        $uri = $uri ?: '/';
        foreach (explode('|', $methods) as $method) {
            static::$routes[] = [
                'uri' => $uri,
                'callback' => $callback,
                'method' => $method,
                'middleware' => static::$middleware
            ];
        }
    }

    public static function post($uri, $callback)
    {
        static::add('POST', $uri, $callback);
    }

    public static function prefix($prefix, $callback)
    {
        $parentPrefix = static::$prefix;
        static::$prefix .= '/' . trim($prefix, '/');
        if (is_callable($callback)) {
            $callback();
        } else {
            throw new BadFunctionCallException('Please provide valid callback function');
        }
        static::$prefix = $parentPrefix;
    }

    public static function middleware($middleware, $callback)
    {
        $parentMiddleware = static::$middleware;
        static::$middleware .= '|' . trim($middleware, '|');
        if (is_callable($callback)) {
            $callback();
        } else {
            throw new BadFunctionCallException('Please provide valid callback function');
        }
        static::$prefix = $parentMiddleware;
    }

    public static function patch()
    {
    }

    public static function put()
    {
    }

    public static function delete()
    {
    }

    public static function any($uri, $callback)
    {
        static::add('GET|POST', $uri, $callback);
    }

    public static function allRoutes()
    {
        return static::$routes;
    }


}