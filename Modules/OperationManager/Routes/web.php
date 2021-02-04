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

Route::prefix('operationmanager')->middleware('operationManager')->group(function() {
    Route::get('/', 'OperationManagerController@index')->name('operationmanager');
    Route::get('/users', 'OperationManagerController@users')->name('operationmanager.users');
});
