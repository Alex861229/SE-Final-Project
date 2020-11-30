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



Route::get('/test', 'UserController@welcome');

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

// 需登入後才能執行
Route::group(['middleware' => 'auth'], function() {
	// 登出
	Route::get('/logout', 'UserController@logout');
	// 顯示個人資料
	Route::get('/showInfo/{user_id}', 'UserController@showInfo');
	// 修改個人資料
	Route::put('/updateInfo/{user_id}', 'UserController@updateInfo');
	// 重製密碼
	Route::put('/resetPassword/{user_id}', 'UserController@resetPassword');
	// 修改密碼
	Route::put('/updatePassword/{user_id}', 'UserController@updatePassword');
	// 刪除帳戶
	Route::delete('/{user_id}/deleteAccount', 'UserController@deleteAccount');
});

