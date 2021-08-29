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

Route::prefix('senioroperationmanager')->middleware('seniorOperationManager')->group(function() {
    Route::get('/', 'SeniorOperationManagerController@index')->name('senioroperationmanager');
    Route::get('/inspection-all', 'SeniorOperationManagerController@branchAllInspections')->name('inspection-all');
    Route::get('/user', 'SeniorOperationManagerController@seniorOperationManagers')->name('senioroperationmanager.user');
    Route::get('/operation-manager', 'SeniorOperationManagerController@operationManagers')->name('senioroperationmanager.operation-manager');
    Route::get('/site-manager', 'SeniorOperationManagerController@siteManagers')->name('senioroperationmanager.site-manager');
    Route::get('/hygiene', 'SeniorOperationManagerController@hygienes')->name('senioroperationmanager.hygiene');
    Route::get('/roles', 'SeniorOperationManagerController@roles')->name('senioroperationmanager.roles');

    //approve hygienes
    Route::get('/approve/{id}/hygiene', 'SeniorOperationManagerController@approveHygiene')->name('senioroperationmanager.approve.hygiene');
    //suspend hygienes
    Route::get('/suspend/{id}/hygiene', 'SeniorOperationManagerController@suspendHygiene')->name('senioroperationmanager.suspend.hygiene');
});
