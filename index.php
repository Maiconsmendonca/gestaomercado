<?php

require_once __DIR__ . '/vendor/autoload.php';
include('app/config/cors.php');

use App\config\router;

$router = new router();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, '/api') === 0) {
    require_once __DIR__ . '/routes/api.php';
} else {
    require_once __DIR__ . '/routes/web.php';
}

$router->dispatch();