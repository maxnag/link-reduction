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

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    /** @var Dingo\Api\Routing\Router $api */
    $api->group(['middleware' => ['cors']], function ($api) {

        /** @var Dingo\Api\Routing\Router $api */
        $api->get('/{key:[0-9A-Za-z]+}', ['as' => 'get.to.url', 'uses' => 'App\API\V1\Controllers\UrlController@getUrlFromKey']);
        $api->post('/create/url', ['as' => 'create.short.url', 'uses' => 'App\API\V1\Controllers\UrlController@createShortUrl']);
    });
});


