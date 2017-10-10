<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers'
], function ($api) {
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'AuthController@login'
    ]);
    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->get('/', [
            'uses' => 'User@getUser',
            'as' => 'api.index'
        ]);
        $api->get('/user', [
            'as' => 'api.auth.user',
            'uses' => 'AuthController@getUser'
        ]);
    });
});