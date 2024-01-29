<?php

namespace App\Http;

class Route
{
    private static $routes = [];

    public static function Get($path, $cb, $middleware = null)
    {
        $path = trim($path, '/');
        self::$routes['GET'][$path] = $cb;
        self::$routes['GET']['MLW'][$path] = $middleware;
    }

    public static function Post($path, $cb, $middleware = null)
    {
        $path = trim($path, '/');
        self::$routes['POST'][$path] = $cb;
        self::$routes['POST']['MLW'][$path] = $middleware;
    }

    public static function dispatch()
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // - En Produccion
        /*
            $path = trim($path, "/");
        */
        // -

        // - En Desarrollo
            $path = trim(join("/", array_slice(explode('/', $path), 3)), "/");
        // -

        foreach (self::$routes[$method] as $route => $cb) {

            $realRoute = $route;

            if (strpos($route, ':') !== false) {
                $route = preg_replace('#:[a-zA-Z]+#', '([a-z0-9]+)', $route);
            }

            if (preg_match("#^$route$#", $path, $matches)) {
                $params = array_slice($matches, 1);

                if (is_callable($cb)) {
                    $res = $cb(...$params);
                }

                if (is_array($cb)) {
                    if (self::$routes[$method]["MLW"][$realRoute] != null) {
                        $handle = new self::$routes[$method]["MLW"][$realRoute];
                        $mdvars = $handle->handle();
                        array_push($params, $mdvars);
                    }
                    $controller = new $cb[0];
                    $res = $controller->{$cb[1]}(...$params);
                }

                if (is_array($res) || is_object($res)) {
                    header("Content-Type: application/json");

                    echo json_encode($res);
                } 

                else {
                    echo $res;
                }
                return;
            }
        }

        header("Location: " . LOCALHOST . "/not-found");
    }

}