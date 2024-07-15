<?php

namespace App\router;

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post($path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function put($path, $handler)
    {
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete($path, $handler)
    {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = rtrim($path, '/');

        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            $segments = explode('@', $handler);
            $controllerName = "App\\" . $segments[0];
            $methodName = $segments[1];

            require_once "api/{$segments[0]}.php";

            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}