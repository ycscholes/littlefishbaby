<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers'
], function ($api) {
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'AuthController@login'
    ]);
    $api->get('/auth/captcha', [
        'as' => 'api.auth.captcha',
        'uses' => 'AuthController@getCaptcha'
    ]);
    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->get('/', [
            'uses' => 'UserController@getUser',
            'as' => 'api.index'
        ]);
        $api->get('/user', [
            'as' => 'api.auth.user',
            'uses' => 'AuthController@getUserResp'
        ]);
        $api->get('/user/tocken_refresh', [
            'as' => 'api.auth.tockenRefresh',
            'uses' => 'AuthController@patchRefresh'
        ]);
    });
});