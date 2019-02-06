<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:25 AM
 */
Route::get('user/add', 'User\Controllers\AddController@showForm');
Route::post('user/add', 'User\Controllers\AddController@add');
Route::get('user', 'User\Controllers\UserController@list')->middleware('auth');