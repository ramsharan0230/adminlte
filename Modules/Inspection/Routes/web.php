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


//reporting...
Route::prefix('inspection')->middleware('auth')->group(function() {
    Route::get('/', 'InspectionController@index')->name('inspection');
    Route::get('/create', 'InspectionController@create')->name('inspection.create');
    Route::post('/store', 'InspectionController@store')->name('inspection.store');
    Route::post('/update', 'InspectionController@update')->name('inspection.update');
    Route::get('/picture/add', 'InspectionController@addPicture')->name('inspection.picture.add');
    Route::post('/picture/add', 'InspectionController@storePicture');
    Route::get('/picture/slider/{id}', 'InspectionController@getSliderImages');
    Route::get('/review-list/{id}', 'InspectionController@reviewList');
    Route::get('/approve/{id}', 'InspectionController@approve')->name('inspection.approve');
    Route::get('/delete/{id}', 'InspectionController@delete')->name('inspection.delete');

    //new report 
    Route::get('{branch_id}/report/pdf', 'InspectionController@inspectionReport')->name('inspection.report.pdf');
    Route::post('{branch_id}/report/pdf', 'InspectionController@inspectionReportPdf')->name('inspection.report.pdf');

    Route::get('{branch_id}/report/excel', 'InspectionController@inspectionReportExcel')->name('inspection.report.excel');
    Route::post('{branch_id}/report/excel', 'InspectionController@inspectionReportExcelStream')->name('inspection.report.excel');
});