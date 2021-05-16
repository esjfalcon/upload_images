<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/select_images', 'ImageController@select_images')->name('select_images')->middleware('auth');
Route::post('/store', 'ImageController@store')->name('store')->middleware('auth');
Route::get('/show', 'ImageController@getImage')->name('getImage')->middleware('auth');
Route::post('/get', 'ImageController@get')->middleware('auth');
Route::get('/newdemande', 'DemandeController@newdemande')->middleware('auth');


