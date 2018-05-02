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


Route::get('/', 'EmployeeController@tree');
Route::get('/employees', 'EmployeeController@ajax')->name('ajax');
//Route::get('/employees', 'EmployeeController@employeesList');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
