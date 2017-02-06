<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/ajax/code/tel', 'Ajax\CodeController@tel');

Route::get('/yuming', 'YumingController@index');

Route::resource('users', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/promise', function() {
    return view('static_pages.promise');
});

Route::get('/notices', 'NoticesController@index');
Route::get('/notices/create', 'NoticesController@create');
Route::post('/notices', 'NoticesController@store');




Route::get('/', function () {
    return view('static_pages.home');
});


