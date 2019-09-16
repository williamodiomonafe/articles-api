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

// Authentication endpoint
$router->post('auth/register', 'AuthController@store');

$router->post('auth/login', 'AuthController@authenticate');

// Article rating endpoint
$router->post('articles/{id}/rating', 'RatingController@store');

// Article search endpoint
$router->post('/articles/search', 'ArticleController@search');

// List all articles endpoint
$router->get('/articles', 'ArticleController@index');

// Get an article endpoint
$router->get('/articles/{id}', 'ArticleController@show');

$router->group(['middleware' => 'jwt.auth'], function() use ($router) {
    $router->put('/articles/{id}', 'ArticleController@update');

    $router->post('/articles', 'ArticleController@store');

    $router->delete('/articles/{id}', 'ArticleController@destroy');
});
