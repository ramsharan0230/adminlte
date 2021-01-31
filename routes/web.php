<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register', 'PagesController@register')->name('register');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
Route::get('/inspects', 'PagesController@inspects')->name('inspects');
Route::get('/inspects/add', 'PagesController@addInspection')->name('inspects.add');
Route::get('/inspects/list', 'PagesController@inspect1')->name('inspects.list');

Route::get('/forgot-password', function(){
    return "hlsdf";
})->name('forgot-password');

Route::get('/home', 'HomeController@index')->name('home');
