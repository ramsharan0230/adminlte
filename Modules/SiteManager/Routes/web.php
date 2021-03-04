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

Route::prefix('sitemanager')->middleware(['siteManger'])->group(function() {
    Route::get('/', 'SiteManagerController@index')->name('sitemanager');
    Route::get('/users', 'SiteManagerController@siteManagers')->name('sitemanager.users');
    Route::post('/review/store', 'SiteManagerController@storeReview')->name('sitemanager.review.store');
    Route::get('/approve/{id}', 'SiteManagerController@approve')->name('sitemanager.approve');
    Route::get('/review-list/{id}', 'SiteManagerController@reviewList')->name('sitemanager.review-list');
    Route::get('/general-users', 'SiteManagerController@general_users')->name('sitemanager.general-users');

    //new
    Route::get('/user/approve/{id}', 'SiteManagerController@approveUser')->name('sitemanager.user.approve');
    Route::get('/user/disapprove/{id}', 'SiteManagerController@disapproveUser')->name('sitemanager.user.disapprove');
    Route::get('/user/normalize/{id}', 'SiteManagerController@normalizeUser')->name('sitemanager.user.normalize');
    Route::get('/user/delete/{id}', 'SiteManagerController@deleteUser')->name('sitemanager.user.delete');

    //reports
    Route::get('/inspection/submitted/pdf', 'SiteManagerController@inspectionSubmittedPdf')->name('sitemanager.inspection.submitted.pdf');
    Route::get('/inspection/submitted/excel', 'SiteManagerController@inspectionSubmittedExcel')->name('sitemanager.inspection.submitted.excel');
    Route::get('/inspection/unsubmitted/pdf', 'SiteManagerController@inspectionUnSubmittedPdf')->name('sitemanager.inspection.unsubmitted.pdf');
    Route::get('/inspection/unsubmitted/excel', 'SiteManagerController@inspectionUnSubmittedExcel')->name('sitemanager.inspection.unsubmitted.excel');
});
