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