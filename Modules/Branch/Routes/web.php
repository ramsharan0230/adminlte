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
    Route::post('/user/create', 'BranchController@create_user')->name('senioroperationmanager.branch.user.store');
    Route::post('/user/update', 'BranchController@update_user')->name('senioroperationmanager.branch.user.update');

    Route::get('/user/delete/{id}', 'BranchController@delete_user')->name('senioroperationmanager.branch.user.delete');
    Route::get('/user/disapprove/{id}', 'BranchController@disapprove_user')->name('senioroperationmanager.branch.user.disapprove');
    Route::get('/user/approve/{id}', 'BranchController@approve_user')->name('senioroperationmanager.branch.user.approve');
    Route::get('/user/enable/{id}', 'BranchController@enable_user')->name('senioroperationmanager.branch.user.enable');
    Route::get('/user/disable/{id}', 'BranchController@disable_user')->name('senioroperationmanager.branch.user.disable');

});
