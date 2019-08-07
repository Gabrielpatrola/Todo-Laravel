<?php

use Illuminate\Http\Request;
use App\Todo;
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

Route::get('/todo/done', 'TodoController@showDone');
Route::get('/todo/active', 'TodoController@showActive');
Route::get('/todo/waiting', 'TodoController@showWaiting');

Auth::routes();

Route::get('/', 'TodoController@index')->name('home');
Route::get('/todo/{id}', 'TodoController@show')->name('todo.edit');

Route::resource('todo', 'TodoController');
