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

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['namespace' => 'App\Http\Controllers\Api\V1\home','prefix' => 'home','as' => 'home.','middleware' => ['api.auth']],function($api){
        $api->get('/', [
            'as' => 'home.index',
            'uses' => 'IndexController@index',
        ]);
    });

});