<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return response()->json([
        'links' => [
            [
                'rel' => 'self',
                'href' => url('/'),
                'type' => 'GET'
            ],
            [
                'rel' => 'v1',
                'href' => url('v1'),
                'type' => 'GET'
            ]
        ]
    ]);
});

/**
 * Version 1 API
 */
$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->post('payments', [
        'uses' => 'v1\ChargeCustomerController',
        'as' => 'charge-cutomer'
    ]);

    $router->get('/', function () {
        return response()->json([
            'links' => [
                [
                    'rel' => 'self',
                    'href' => url('v1'),
                    'type' => 'GET'
                ],
                [
                    'rel' => 'charge-customer',
                    'href' => url('v1/payments'),
                    'type' => 'POST'
                ]
            ]
        ]);
    });

});
