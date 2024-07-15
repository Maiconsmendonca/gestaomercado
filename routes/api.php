<?php

use router\router;

$router = new Router();

// Rota para listar todos os produtos
$router->get('/products', 'ProductsController@index');

// Rota para obter detalhes de um produto específico
$router->get('/products/{id}', 'ProductsController@show');

// Rota para criar um novo usuário
$router->post('/users', 'UsersController@store');

// Rota para atualizar dados de um usuário
$router->put('/users/{id}', 'UsersController@update');

// Rota para excluir um usuário
$router->delete('/users/{id}', 'UsersController@destroy');

// Executa as rotas
$router->dispatch();
