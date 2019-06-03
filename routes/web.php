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

#登入
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
#登出
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

#註冊
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

#忘記密碼
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/', function () {
//     return view('welcome');
// });
//首頁
Route::get('/', function () {
    return view('index');
})->name('index');
//顯示最新訊息
Route::get('posts','PostsController@index')->name('posts.index');
//新增訊息
Route::get('posts/create','PostsController@create')->name('posts.create');
//儲存訊息
Route::post('posts/store','PostsController@store')->name('posts.store');
//秀出指定訊息
Route::get('posts/{id}','PostsController@show')->name('posts.show');
//修改指定訊息
Route::get('posts/{id}/edit','PostsController@edit')->name('posts.edit');
//確定修改訊息
Route::patch('posts/{id}','PostsController@update')->name('posts.update');
//刪除訊息
Route::delete('posts/{id}','PostController@destory')->name('posts.destory');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
