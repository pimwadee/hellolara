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

Route::get('hello', function () {
    return view('hello');
});

Route::get('schools', 'ChildSourceController@schools');

Route::get('parents', 'ChildSourceController@parents')->middleware('auth');

Route::get('hospitals', 'ChildSourceController@hospitals');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile',"UserController@profile")->name('profile');
Route::get('ConnectKD',"UserController@ConnectKD");

Route::get('/auth/callback',"UserController@callback")->name('callback');