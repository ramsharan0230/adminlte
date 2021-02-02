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

Route::prefix('hygiene')->middleware('hygiene')->group(function() {
    Route::get('/', 'HygieneController@index')->name('hygiene');
    Route::get('/create', 'HygieneController@create')->name('hygiene.create');
    Route::post('/inspection/store', 'HygieneController@store')->name('inspection.store');
});
