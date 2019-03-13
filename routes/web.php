<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return 'web site html';
});
Route::get('/admin', function () {
    return view('dashboard');
});
Route::get('/admin/dashboard', function () {
    return view('welcome');
});
Route::get('logout',function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('login');
});