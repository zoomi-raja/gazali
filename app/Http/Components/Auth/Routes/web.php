<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/5/2019
 * Time: 2:38 PM
 */
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'Auth\Controllers\LoginController@showLoginForm');
    Route::get('register', 'Auth\Controllers\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\Controllers\RegisterController@registerUser');
});