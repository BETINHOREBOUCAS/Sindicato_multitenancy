<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/sair', 'HomeController@sair');
$router->get('/login', 'LoginController@login');
$router->post('/login', 'LoginController@loginAction');

$router->get('/receitas', 'ReceitasController@index');
$router->post('/receitas', 'ReceitasController@registrar');

$router->get('/despesas', 'DespesasController@index');
$router->post('/despesas', 'DespesasController@registrar');

$router->get('/relatorios', 'RelatoriosController@index');
$router->post('/relatorios', 'RelatoriosController@registrar');

$router->get('/apagar/{id}', 'RelatoriosController@excluirAction');
$router->get('/apagar', 'RelatoriosController@excluir');

$router->get('/somar_sindicato/{comando}', 'CarteirasController@index');
$router->get('/sindicato/add', 'CarteirasController@addAno');
$router->get('/somar_sindicato', 'CarteirasController@index');