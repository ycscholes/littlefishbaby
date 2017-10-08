<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers'
], function ($api) {
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'AuthController@login',
    ]);
    $api->get('/', function () {
        $a = 1;
        echo $a;
    });
});