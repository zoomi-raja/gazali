<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/5/2019
 * Time: 2:38 PM
 */
Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    Route::get('login', 'Admin\Auth\Controllers\LoginController@showLoginForm');
    Route::get('register', 'Admin\Auth\Controllers\RegisterController@showRegistrationForm');
    Route::post('register', 'Admin\Auth\Controllers\RegisterController@registerUser');
});

//Route::group([ 'prefix' => 'admin', 'middleware' => 'guest'],function ($router) {
//    $router->get('login', 'Admin\Auth\Controllers\LoginController@showLoginForm');
//    $router->get('register', 'Auth\Controllers\RegisterController@showRegistrationForm');
//    $router->post('register', 'Auth\Controllers\RegisterController@registerUser');
//});