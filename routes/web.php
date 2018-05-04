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


Route::get('/', 'EmployeeController@tree')->name('home');
Route::post('/', 'EmployeeController@getChild')->name('child');




Route::group(['middleware' => 'auth'], function () {
    Route::get('/employees', 'EmployeeController@employeesList')->name('employees');
    Route::post('/employees', 'EmployeeController@getEmployees')->name('employees.json');
    Route::get('/employees/edit/{id}', 'EmployeeController@edit')->where(['id' => '[0-9]+'])->name('editForm');
    Route::post('/employees/edit/{id}', 'EmployeeController@updateOrDelete')->where(['id' => '[0-9]+'])->name('edit');


});




Auth::routes();

Route::get('/home', 'HomeController@index');
