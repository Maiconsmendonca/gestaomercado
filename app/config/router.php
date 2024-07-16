<?php

namespace App\config;

class router
{
    private static $routes = [];

    public static function add($method, $path, $action)
    {
        self::$routes[] = ['method' => $method, 'path' => $path, 'action' => $action];
    }

    public static function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $apiPrefix = '/api';
        if (str_starts_with($requestUri, $apiPrefix)) {
            $requestUri = substr($requestUri, strlen($apiPrefix));
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = preg_replace('#\{([a-z]+)\}#', '([^/]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $requestUri, $matches) && strtolower($route['method']) === strtolower($requestMethod)) {
                array_shift($matches); // Remove the full match result
                list($controllerName, $methodName) = explode('@', $route['action']);

                $controllerClass = "App\\Controller\\" . $controllerName;
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $methodName)) {
                        call_user_func_array([$controller, $methodName], $matches);
                        return;
                    } else {
                        echo "Método $methodName não encontrado no controlador $controllerClass";
                        http_response_code(404);
                        return;
                    }
                } else {
                    echo "Controlador $controllerClass não encontrado";
                    http_response_code(404);
                    return;
                }
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
}