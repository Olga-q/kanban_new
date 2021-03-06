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

Route::get('/home', 'HomeController@index');
Route::post('/task/add', 'TaskController@add');
Route::post('/task/del', 'TaskController@del');
Route::get('/task/show', 'TaskController@show');
Route::get('/user/show', 'UserController@show');