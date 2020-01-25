<?php

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

// call users with citizenship
$router->get('/users/{status}/{citizenship_code}', [
    //'middleware' => 'auth',
    'uses' => 'UserController@getUsers'
]);

// call update existent user
$router->put('user/{id}', 'UserController@update');

// call delete existent user
$router->delete('user/{id}', 'UserController@delete');

// call transactions
$router->get('/transactions', 'TransactionController@getTransactions');

