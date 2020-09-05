<?php


namespace PhpFramework\Router;


use BadFunctionCallException;
use http\Exception\InvalidArgumentException;
use PhpFramework\Http\Request;
use ReflectionException;

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

    public static function handle()
    {
        $uri = Request::url();
        foreach (static::$routes as $route) {
            $matched = true;
            $route['uri'] = preg_replace('/\/{(.*?)}/', '/(.*?)', $route['uri']);
            $route['uri'] = '#^' . $route['uri'] . '$#';
//            if (preg_match($route['uri'], $uri, $matches)) {
//            array_shift($matches);
//            $params = array_values($matches);
//            foreach ($params as $param) {
//                if (strpos($param, '/')) {
//                    $matched = false;
//                }
//            }
            if ($route['method'] != Request::method()) {
                $matched = false;
            }
            if ($matched == true) {
                return static::invoke($route, []);
            }
//            }
        }

    }

    private static function invoke($route, array $params)
    {
        $callback = $route['callback'];
        if (is_callable($callback)) {
            return call_user_func_array($callback, $params);
        }
        if (strpos($callback, '@') !== false) {
            [$controller, $method] = explode('@', $callback);
            $controller = 'App\Controllers\\' . $controller;
            if (class_exists($controller)) {
                $object = new $controller;
                if (method_exists($object, $method)) {
                    return call_user_func_array([$object, $method], $params);
                } else {
                    throw new BadFunctionCallException('The Method ' . $method . ' is not Exists at ' . $controller);
                }
            } else {
                throw new ReflectionException('class ' . $controller . ' Not Found');
            }
        } else {
            throw new InvalidArgumentException('please provide valid callback');
        }
    }


}