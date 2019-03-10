<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/10/2019
 * Time: 9:49 AM
 */

Route::prefix('api')->group(function ($router) {
    $router->get('login', 'Auth\Controllers\LoginController@showFields');
    $router->post('login', 'Auth\Controllers\LoginController@login');
});
//Route::group(['middleware' => 'jwt-auth'], function($router) {
//});