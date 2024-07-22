<?php

use App\config\router as Router;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

define('BASE_URL', '/');

$router = new Router();

$router->group('/api', function ($router) {
    require_once __DIR__.'/../routes/api.php';
});

require_once __DIR__.'/../routes/web.php';

$router->dispatch();
