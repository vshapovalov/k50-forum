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

Auth::routes();

Crud::routes();

Route::group(['as' => 'auth.'], function(){
	Route::get('auth/{provider}', ['as'=>'provider', 'uses' => 'Auth\AuthController@redirectToProvider']);
	Route::get('auth/{provider}/callback', ['as'=>'provider.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);
});

Route::group(['as' => 'posts.'], function(){
	Route::get('/{category}/{page?}', ['as'=>'index', 'uses' => 'PostController@getPosts'])->where(['category' => ''])->name('category');
	Route::get('/{category}/{slug}', ['as'=>'index', 'uses' => 'PostController@getPost'])->where(['slug' => ''])->name('post');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
	return view('welcome');
});
