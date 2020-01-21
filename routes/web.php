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
// 以下URIとAction内容
Route::resource('todo', 'TodoController');

// 上記のルート指定１行のみで以下のルート指定を全て取り込んでしまっている
// Route::get('/todo', 'TodoController@index')->name('todo.index');
// Route::get('/todo/{id}', 'TodoController@show')->name('todo.show');
// Route::get('/todo/create', 'TodoController@create')->name('todo.create');
// Route::post('/todo', 'TodoController@store')->name('todo.store');
// Route::get('/todo/{id}/edit', 'TodoController@edit')->name('todo.edit');
// Route::put('/todo/{id}', 'TodoController@update')->name('todo.update');
// Route::delete('/todo/{id}', 'TodoController@destroy')->name('todo.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
