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

Route::get('siswa','App\Http\Controllers\siswaController@index');
Route::get('siswaUpdate','App\Http\Controllers\siswaController@update');
Route::get('siswaHapus','App\Http\Controllers\siswaController@destroy');