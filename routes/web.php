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
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1\home','prefix' => 'home','as' => 'home.'],function($api){
       $api->get('/dream','IndexController@dream');//解梦
       $api->any('/star','IndexController@star');//运势
       $api->get('/login','LoginController@login');//登录
       $api->get('/get_user_info','LoginController@get_user_info');//获取用户信息
       $api->get('/update_user_info','LoginController@update_user_info');//更新用户信息
       $api->get('/suggestion','IndexController@suggestion');//意见建议
       $api->get('/mate','IndexController@mate');//姓名配对
    });
    
    

});