<?php

use App\config\router;

// Rota para teste
router::add('GET', '/teste', 'TesteController@teste');

// Rota para criar um produto
router::add('POST', '/product', 'ProductController@store');

// Rota para listar todos os produtos
router::add('GET', '/product', 'ProductController@index');

// Rota para buscar um produto específico pelo ID
router::add('GET', '/product/{id}', 'ProductController@show');

// Rota para atualizar um produto específico pelo ID
router::add('PUT', '/product/{id}', 'ProductController@update');

// Rota para deletar um produto específico pelo ID
router::add('DELETE', '/product/{id}', 'ProductController@destroy');