<?php

require_once __DIR__ . '/vendor/autoload.php';
include('app/config/cors.php');

use App\config\router;

$router = new router();

// Determina se a requisição é para a API ou para a web
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, '/api') === 0) {
    // Inclui as rotas da API
    require_once __DIR__ . '/routes/api.php';
} else {
    // Inclui as rotas web
    require_once __DIR__ . '/routes/web.php';
}

// Despacha a requisição para a rota correspondente
$router->dispatch();