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
    return view('welcome');
});
Route::get('/user', function () {
    return view('user');
});
Route::get('/message', function () {
    return view('message');
});
Route::get('/admin', function () {
    return view('admin');
});



Route::get('/test', function () {
    return view('test_welcome');
});

// ========================================== Auth ==========================================
// Auth::routes();
// Custom Auth Route
// Authentication Routes...

// 註冊

Route::get('/register', function () {
    return view('test_register');
});
Route::post('/register', 'UserController@register');

// 登入
Route::get('/login', function () {
    return view('test_login');
});
Route::post('/login', 'UserController@login');

// 登出

Route::group(['before'=>'auth'], function(){
	Route::get('/logout', 'UserController@logout');
});