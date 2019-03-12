<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/10/2019
 * Time: 9:49 AM
 */

Route::prefix('admin/api')->group(function ($router) {
    $router->get('login', 'Admin\Auth\Controllers\LoginController@showFields');
    $router->post('login', 'Admin\Auth\Controllers\LoginController@login');
    $router->get('auth', function (){
        return ['status' => true ];
    })->middleware('jwt-auth');
});
//Route::group(['middleware' => 'jwt-auth'], function($router) {
//});
