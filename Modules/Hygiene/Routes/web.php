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
    Route::get('/list', 'HygieneController@index')->name('hygiene.list');
    Route::get('/users', 'HygieneController@users')->name('hygiene.users');
    Route::post('/user/update', 'HygieneController@updateUser')->name('hygiene.user.update');
    Route::post('/inspection/review', 'HygieneController@saveReview')->name('hygiene.inspection.review');
    Route::post('/inspection/update/status', 'HygieneController@updateStatus')->name('inspection.update.status');
    
    //reporting...
    Route::get('/inspection-submitted-pdf', 'HygieneController@inspectionSubmittedPdf')->name('hygiene.inspection.submitted.pdf');
    Route::get('/inspection-submitted-excel', 'HygieneController@inspectionSubmittedExcel')->name('hygiene.inspection.submitted.excel');

});
