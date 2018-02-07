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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view', 'ViewController@index')->name('view');
Route::get('/', 'PostsController@welcome')->name('welcome');

//POSTS
Route::get('/edit', 'PostsController@index')->name('add');
Route::post('/edit', 'PostsController@addPostRequest');

Route::get('/{id}', 'PostsController@viewPost')->where('id','\d+')->name('view');
Route::get('/edit/{id}', 'PostsController@editPost')->where('id','\d+')->name('edit');
Route::post('/edit/{id}', 'PostsController@editPostRequest')->where('id','\d+');

Route::get('/delete/{id}','PostsController@deletePost')->where('id','\d+')->name('delete');
