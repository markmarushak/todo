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

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('task', ['as' => 'task.index', 'uses' => 'TaskController@index']);
	Route::post('task', ['as' => 'task.add', 'uses' => 'TaskController@add']);
	Route::get('task/show', ['as' => 'task.show', 'uses' => 'TaskController@show']);

	Route::get('categories', ['as' => 'task.show', 'uses' => 'CategoryController@show']);
	Route::post('categories', ['as' => 'task.add', 'uses' => 'CategoryController@add']);
	Route::put('categories', ['as' => 'task.update', 'uses' => 'CategoryController@update']);
	Route::delete('categories', ['as' => 'task.delete', 'uses' => 'CategoryController@delete']);

});

