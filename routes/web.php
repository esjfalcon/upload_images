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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/select_images', 'ImageController@select_images')->name('select_images')->middleware('auth');;
Route::post('/store', 'ImageController@store')->name('store')->middleware('auth');;
Route::get('/show', 'ImageController@getImage')->name('getImage')->middleware('auth');;

// Route::get('/show', function () {
//     return view('show');
// });
