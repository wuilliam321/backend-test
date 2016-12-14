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

Route::get('/', 'EventsController@index')->name('main');
Route::get('/events', 'EventsController@index')->name('main');
Route::get('/events/create', 'EventsController@create')->name('add')->middleware('auth');
Route::post('/events/create', 'EventsController@save')->name('create')->middleware('auth');
Route::get('/events/{id}', 'EventsController@view')->name('view');
Route::get('/events/{id}/edit', 'EventsController@edit')->name('edit')->middleware('auth');
Route::post('/events/{id}', 'EventsController@update')->name('update')->middleware('auth');
Auth::routes();
