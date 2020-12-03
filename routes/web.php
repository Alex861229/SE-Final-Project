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


//  Cheng
Route::get('/test', 'UserController@welcome');
Route::get('/search', 'SiteController@index');
Route::get('/search/result', 'SiteController@search');
Route::get('/search/{country}/{site_id}/message', 'SiteController@siteAllMsg');

// ========================================== Auth ==========================================
// Auth::routes();
// Custom Auth Route
// Authentication Routes...

Route::group(['middleware' => 'guest'], function() {
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
});

// 需登入後才能執行
Route::group(['middleware' => 'auth'], function() {
	// 登出
	Route::get('/logout', 'UserController@logout');
	// 顯示個人資料
	Route::get('/showInfo/{user_id}', 'UserController@showInfo');
	// 修改個人資料
	Route::get('/updateInfo/{user_id}', 'UserController@updateInfoModal');
	// 修改個人資料
	Route::put('/updateInfo/{user_id}', 'UserController@updateInfo');
	// 重製密碼
	Route::put('/resetPassword/{user_id}', 'UserController@resetPassword');
	// 修改密碼
	Route::put('/updatePassword/{user_id}', 'UserController@updatePassword');
	// 刪除帳戶
	Route::delete('/{user_id}/deleteAccount', 'UserController@deleteAccount');
});

// 不需登入：留言功能
// 顯示所有留言
// Route::get('/{country}/{site_id}', 'MsgController@index');
// 查看留言詳情
// Route::get('/{country}/{site_id}/{msg_id}', 'MsgController@show'); 

// 需登入：留言功能
Route::group(['middleware' => 'auth'], function() {
	// // 顯示該名User的所有留言
	// Route::get('/message/{user_id}', 'MsgController@index_user');
	// 新增留言
    Route::post('/{country}/{site_id}', 'MsgController@store');
    // 刪除留言
    // Route::delete('/{country}/{msg_id}', 'MsgController@destroy'); 
    // // 編輯留言
    // Route::get('/{country}/{msg_id}/edit','MsgController@edit');
    // Route::patch('/{country}/{msg_id}', 'MsgController@update');
});