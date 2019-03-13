<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:25 AM
 */

Route::middleware('auth')->group(function(){
    Route::get('user/add', 'User\Controllers\AddController@showForm');
    Route::post('user/add', 'User\Controllers\AddController@add');
    Route::get('user', 'User\Controllers\UserController@list');
    Route::get('user/{id}', 'User\Controllers\UserController@detail');

    Route::get('user/{id}/edit', 'User\Controllers\UserEditController@detail');
    Route::post('user/{id}/edit', 'User\Controllers\UserEditController@update');
});