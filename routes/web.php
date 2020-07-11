<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'UsersController@index');
Route::get('/action', 'UsersController@action')->name('index.action');
Route::get('/user/{id}/action', 'UsersController@action__user')->name('show.action');
Route::get('/user/create', 'UsersController@create');
Route::post('/', 'UsersController@store');
Route::get('/user/{id}', 'UsersController@show');
Route::get('/user/{id}/repairs', 'UsersController@repairs');
Route::post('/repairs', 'UsersController@repairs_store');
Route::get('/user/{id}/edit', 'UsersController@edit');
Route::get('/user/repairs/{id}/edit', 'UsersController@repairs_edit');
Route::get('/user/repairs/{id}', 'UsersController@repairs_show');
Route::put('/user/{id}', 'UsersController@update');
Route::put('/user/repairs/{id}', 'UsersController@repairs_update');
Route::delete('users/{id}', 'UsersController@destroy');
Route::delete('users/{id}/repairs', 'UsersController@repairs_destroy');
