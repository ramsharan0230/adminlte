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

Route::prefix('senioroperationmanager/branch')->middleware(['auth'])->group(function() {
    Route::get('/', 'BranchController@index')->name('senioroperationmanager.branch');
    Route::get('/create', 'BranchController@index')->name('senioroperationmanager.branch.create');
    Route::post('/store', 'BranchController@store')->name('senioroperationmanager.branch.store');
    Route::post('/update', 'BranchController@update')->name('senioroperationmanager.branch.update');
    Route::get('/disapprove/{id}', 'BranchController@disapprove')->name('senioroperationmanager.branch.disapprove');
    Route::get('/approve/{id}', 'BranchController@approve')->name('senioroperationmanager.branch.approve');
    Route::get('/detail/{id}', 'BranchController@detail')->name('senioroperationmanager.branch.detail');
});
