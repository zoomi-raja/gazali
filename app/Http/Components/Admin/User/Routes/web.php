<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:25 AM
 */
//Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
//    Route::get('user/add', 'Admin\User\Controllers\AddController@showForm');
//    Route::post('user/add', 'Admin\User\Controllers\AddController@add');
//    Route::get('user', 'Admin\User\Controllers\UserController@list');
//    Route::get('user/{id}', 'Admin\User\Controllers\UserController@detail');
//
//    Route::get('user/{id}/edit', 'Admin\User\Controllers\UserEditController@detail');
//    Route::post('user/{id}/edit', 'Admin\User\Controllers\UserEditController@update');
//});


Route::get('admin/user/', function(){
    return view('userList');
});
Route::get('admin/user/test', 'Admin\User\Controllers\UserController@test');