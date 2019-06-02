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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('test','TestController@test');

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'developer', 'middleware' => ['auth', 'role:developer']], function () {
    Route::get('/', 'DevController@index');
    Route::post('/change-status', 'DevController@changeStatus');
});

Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'role:manager']], function () {
    Route::get('task', 'TaskController@index');

    Route::get('task/create', 'TaskController@create');
    Route::post('task/create', 'TaskController@store');

    Route::get('task/{task}/edit', 'TaskController@edit');
    Route::post('task/{task}/update', 'TaskController@update');

    Route::post('task/assign-to', 'TaskController@assignTo');
});
