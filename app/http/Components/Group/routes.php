<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:25 AM
 */
//Route::get('group/add', 'Group\Controllers\AddController@showForm');
//Route::post('group/add', 'Group\Controllers\AddController@add');
Route::get('group', 'Group\Controllers\GroupController@list');