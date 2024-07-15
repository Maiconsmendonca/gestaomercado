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
        // Remove o prefixo '/api' do requestUri
        $apiPrefix = '/api';
        if (substr($requestUri, 0, strlen($apiPrefix)) === $apiPrefix) {
            $requestUri = substr($requestUri, strlen($apiPrefix));
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['path'] === $requestUri && strtolower($route['method']) === strtolower($requestMethod)) {
                list($controllerName, $methodName) = explode('@', $route['action']);

                $controllerClass = "App\\Http\\Controllers\\" . $controllerName;
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $methodName)) {
                        call_user_func_array([$controller, $methodName], []);
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