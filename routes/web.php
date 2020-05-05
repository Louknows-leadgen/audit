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

Route::get('/','SuperAdminController@index')->name('root');
Route::get('/admin','AdminController@index')->name('admin.index');

Route::get('/supervisor','SupervisorController@index')->name('supervisor.index');
Route::get('/search-calls','SupervisorController@search_calls')->name('supervisor.search_calls');
Route::post('/assign-calls','SupervisorController@assign_calls')->name('supervisor.assign_calls');

Route::get('/auditor','AuditorController@index')->name('auditor.index');

Route::get('/account','UserController@index')->name('user.index');
Route::put('/account/update','UserController@update_account')->name('user.update_account');
Route::put('/account/password/update','UserController@update_password')->name('user.update_password');

Auth::routes();

