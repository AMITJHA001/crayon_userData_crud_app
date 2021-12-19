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

Route::get('/', 'UserDataController@index');

Route::post('useradd','UserDataController@store');

Route::get('useredit/{id}','UserDataController@edit');

Route::put('userupdate','UserDataController@update');