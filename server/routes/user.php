<?php

// $router->group(['prefix' => 'users', ['namespace' => 'Users']], function () use ($router) {
//     $router->get('/', function ()    {
//         return Users::getUsers();
//     });
// });

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/users/{id}', 'UserController@getUsers');
});