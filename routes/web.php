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

Route::get('/', 'TranslationController@home')->name('home');
Route::post('/valid', 'TranslationController@valid')->name('valid');

Route::get('/admin', 'AdministrationController@admin')->name('admin');
Route::post('/admin/import', 'AdministrationController@import')->name('import');
Route::post('/admin/export', 'AdministrationController@export')->name('export');