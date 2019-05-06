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

Route::get('/', function() {
    return view('index');
})->middleware('guest');

Route::get('/home', 'MessageController@index')->name('home');

Auth::routes();

Route::post('/messages', 'MessageController@store');

Route::get('/likes', 'LikeController@index')->name('likes');

Route::put('/likes/{message}', 'LikeController@likeHandle');