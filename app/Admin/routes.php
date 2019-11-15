<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->group(['prefix' => 'dada'],
        function($router){
            $router->get('/test', 'AuthController@test');
        }
    );

    $router->resource('test', TestController::class);

});
