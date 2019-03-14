<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/14/2019
 * Time: 11:41 AM
 */
Route::group([ 'prefix' => 'admin/api', 'middleware' => 'jwt-auth'], function($router) {
    $router->get('user', 'Admin\User\Controllers\UserController@list');
    $router->post('user', 'Admin\User\Controllers\UserController@create');
});