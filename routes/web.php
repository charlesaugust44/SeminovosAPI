<?php

use Laravel\Lumen\Routing\Router;

/** @var Router router */
function routes(Router $router)
{

    $router->group(['namespace' => 'App\Http\Controllers'], function (Router $router) {
        $router->get('vehicles', [
            'uses' => 'VehicleController@readAll'
        ]);

        $router->get('vehicles/{id}', [
            'uses' => 'VehicleController@read'
        ]);
    });

}