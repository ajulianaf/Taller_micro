<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
 
    return $router->app->version();
});

$router -> put ('/estados/{id}', 'TareaController@estado');
$router -> get('/tareas', 'TareaController@index');
$router -> get ('/tareas/filter', 'TareaController@filter');
$router -> put ('/reasignar/{id}', 'TareaController@reasignar');
$router -> post('/tareas', 'TareaController@store');
$router -> put('/tareas/{id}', 'TareaController@update');
$router -> delete('/tareas/{id}', 'TareaController@destroy');
