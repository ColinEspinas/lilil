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

Route::get('/home', 'ActivityController@index')->name('home');

Auth::routes();

Route::post('/messages', 'MessageController@store');
Route::delete('/messages/{message}', 'MessageController@destroy');
Route::patch('/messages/{message}', 'MessageController@update');

Route::get('/likes', 'LikeController@index')->name('likes');
Route::put('/likes/{message}', 'LikeController@likeHandle');

Route::get("/follows", 'FollowController@index')->name('follows');
Route::put('/follows/{user}', 'FollowController@followHandle');
Route::delete('/follows/{user}', 'FollowController@unfollow');

Route::get('/users/{user}','UserController@show');
Route::patch('/users/{user}', 'UserController@update');

Route::get('/users/{user}/edit','UserController@edit');
Route::get('/users/{user}/delete','UserController@destroy');


Route::get('/shares', 'ShareController@index')->name('shares');
Route::put('/shares/{message}', 'ShareController@shareHandle');


Route::get('/tendencies','TendenciesController@index')->name('tendencies');

Route::get('/search','SearchController@search')->name('search');

