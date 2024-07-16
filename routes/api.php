<?php

use App\config\router;

// Rotas de produtos

router::add('GET', '/product', 'ProductController@index');
router::add('GET', '/product/{id}', 'ProductController@show');
router::add('POST', '/product', 'ProductController@store');
router::add('PUT', '/product/{id}', 'ProductController@update');
router::add('DELETE', '/product/{id}', 'ProductController@destroy');

// Rotas de Tipo de Produtos

router::add('GET', '/product-type', 'ProductTypeController@index');
router::add('GET', '/product-type/{id}', 'ProductTypeController@show');
router::add('POST', '/product-type', 'ProductTypeController@store');
router::add('PUT', '/product-type/{id}', 'ProductTypeController@update');
router::add('DELETE', '/product-type/{id}', 'ProductTypeController@destroy');

// Rotas de Vendas

router::add('GET', '/sales', 'SaleController@index');
router::add('GET', '/sales/{id}', 'SaleController@show');
router::add('POST', '/sales', 'SaleController@store');
router::add('PUT', '/sales/{id}', 'SaleController@update');
router::add('DELETE', '/sales/{id}', 'SaleController@destroy');

// Rotas de Taxas

router::add('GET', '/taxes', 'TaxController@index');
router::add('GET', '/taxes/{id}', 'TaxController@show');
router::add('POST', '/taxes', 'TaxController@store');
router::add('PUT', '/taxes/{id}', 'TaxController@update');
router::add('DELETE', '/taxes/{id}', 'TaxController@destroy');
