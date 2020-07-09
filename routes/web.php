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
Route::get('/user/create', 'UsersController@create');
Route::post('/', 'UsersController@store');
Route::get('/user/{id}', 'UsersController@show');
Route::get('/user/{id}/repairs', 'UsersController@repairs');
Route::post('/repairs', 'UsersController@repairs_store');
