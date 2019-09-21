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

//この行を追記
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('show/{id}', 'UsersController@show')->name('users.show');
    Route::get('edit/{id}', 'UsersController@edit')->name('users.edit'); 
    Route::post('update/{id}', 'UsersController@update')->name('users.update'); 
});

Auth::routes();

Route::get('/', function () {
return view('top');
});

Route::get('/home', 'HomeController@index')->name('home');