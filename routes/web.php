<?php

// /** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
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
    return 'Welcome!!';
});

$router->group(['prefix' => 'api'], function () use ($router)
{
    //AUTH routes
    $router->post('/auth/login', 'AuthController@login');
    $router->patch('/auth/{email}/{verificationCode}/activate', 'AuthController@activate');
    $router->delete('/auth/logout', 'AuthController@logout');


    $router->post('/users', 'UserController@create');

    // $router->group(['middleware' => "auth:ADMIN"], function ($router) {

        //USER routes
        $router->put('/users/{id}', 'UserController@update');
        $router->get('/users/{id}', 'UserController@get');
        $router->get('/users', 'UserController@getAll');
        $router->patch('/users/{id}/enable', 'UserController@enable');
        $router->patch('/users/{id}/disable', 'UserController@disable');


        //ROLE routes
        $router->post('/roles', 'RoleController@create');
        $router->put('/roles/{id}', 'RoleController@update');
        $router->patch('/roles/{id}/enable', 'RoleController@enable');
        $router->patch('/roles/{id}/disable', 'RoleController@disable');

        //USER-ROLE routes
        $router->post('/users/{userId}/roles/{roleId}', 'UserRoleController@create');
        $router->post('/users/{id}/roles', 'UserRoleController@roles');
        $router->delete('/users/{userId}/roles/{roleId}', 'UserRoleController@delete');

        //lookups
        $router->post('/lookups', 'LookupController@create');
        $router->patch('/lookups/{id}', 'LookupController@update');
        $router->get('/lookups/{id}', 'LookupController@get');
        $router->get('/lookups/{type}/lookups-by-type', 'LookupController@getLookups');
        $router->get('/lookups', 'LookupController@getAll');
        $router->get('/lookups/query/{attribute}/{value}', 'LookupController@query');
        $router->delete('/lookups', 'LookupController@delete');
        $router->patch('/lookups/{id}/toggle-status', 'LookupController@toggleStatus');

        //lookup types
        $router->post('/lookup-types', 'LookupTypeController@create');
        $router->patch('/lookup-types/{id}', 'LookupTypeController@update');
        $router->get('/lookup-types/{id}', 'LookupTypeController@get');
        $router->get('/lookup-types/{type}/lookups', 'LookupTypeController@getLookups');
        $router->get('/lookup-types', 'LookupTypeController@getAll');
        $router->get('/lookup-types/query/{attribute}/{value}', 'LookupTypeController@query');
        $router->delete('/lookup-types', 'LookupTypeController@delete');
        $router->patch('/lookup-types/{id}/toggle-status', 'LookupTypeController@toggleStatus');

        //Customer ROUTES
        $router->post('/contact-manager/customers', 'CustomerController@create');        
        $router->put('/contact-manager/customers/{id}', 'CustomerController@update');
        $router->get('/contact-manager/customers/{id}', 'CustomerController@get');
        $router->get('/contact-manager/customers', 'CustomerController@getAll');
        $router->get('/contact-manager/customers/query/{attribute}/{value}', 'CustomerController@query');
        $router->post('/contact-manager/customers/filter', 'CustomerController@filter');
        $router->delete('/contact-manager/customers/{id}', 'CustomerController@delete');
        $router->patch('/contact-manager/customers/{id}/toggle-status', 'CustomerController@toggleStatus');
        $router->get('/contact-manager/customers/{id}/items', 'CustomerController@items');

        //OTHER ROUTES

    // });
});
