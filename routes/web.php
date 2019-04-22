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
    $res['success'] = true;
    $res['result'] = "Welcome to LKS Jatim 2019. This is RestFull Web Service using Lumen !";
    return response($res);
});

// user
$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@login');
$router->get('/auth', 'UserController@authenticate');

// event
$router->get('/event', 'EventController@getAllEvent');
$router->get('/event/{id}', 'EventController@getEvent');
$router->post('/event', ['middleware' => 'auth', 'uses' => 'EventController@create']);
$router->post('/event/update/{id}', ['middleware' => 'auth', 'uses' => 'EventController@update']);
$router->get('/event/delete/{id}', ['middleware' => 'auth', 'uses' => 'EventController@delete']);
$router->post('/event/join', ['middleware'=> 'auth', 'uses' => 'EventController@join']);
$router->post('/event/unjoin', ['middleware'=> 'auth', 'uses' => 'EventController@unjoin']);
$router->get('/event/user/{id}', ['middleware'=> 'auth', 'uses' => 'EventController@getEventRegisteredByUser']);
$router->get('/event/member/{id}', ['middleware'=> 'auth', 'uses' => 'EventController@getEventUserRegister']);
