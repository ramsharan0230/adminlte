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
});
