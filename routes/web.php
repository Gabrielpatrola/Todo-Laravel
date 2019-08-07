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

Route::get('/todo/active/{page?}', function ($page = 1) {
    $todo = new Todo();
    $result = $todo
        ->where('status', '=', 'ACTIVE')
        ->forPage($page, 10)
        ->get();
    // return $result;
    return view('active', ['todos' => $result, 'page' => $page]);
}); 
/**
 * Get the DONE todo tasks for a given page.
 */
Route::get('/todo/done/{page?}', function ($page = 1) {
    $todo = new Todo();
    $result = $todo
        ->where('status', '=', 'DONE')
        ->forPage($page, 10)
        ->get();
    // return $result;
    return view('done', ['todos' => $result, 'page' => $page]);
}); 
/**
 * Get the waiting todo tasks for a given page.
 */
Route::get('/todo/waiting/{page?}', function ($page = 1) {
    $todo = new Todo();
    $result = $todo
        ->where('status', '=', 'WAITING')
        ->forPage($page, 10)
        ->get();
    // return $result;
    //dd($todo->user()->get());
    return view('waiting', ['todos' => $result, 'page' => $page]);
}); 
/**
 * Get a specific todo task by id.
 */
Route::get('/todo/{id}', 'TodoController@getTodoById');

Route::put('/todo/{id}', 'TodoController@updateTodoById');

Route::delete('/todo/{id}', 'TodoController@deleteTodoById');
 
Auth::routes();

Route::get('/', 'TodoController@index')->name('home');

Route::resource('todo', 'TodoController');
