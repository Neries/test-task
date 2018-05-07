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

Route::view('/', 'tree')->name('home');
Route::post('/', 'EmployeeController@tree')->name('treeView');

Auth::routes();
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/employees', 'employees')->name('employees');
    Route::post('/employees', 'EmployeeController@getEmployees')->name('employees.json');

    Route::view('/employees/create', 'edit')->name('createForm');
    Route::get('/employees/edit/{id}', 'EmployeeController@editForm')->where(['id' => '[0-9]+'])->name('editForm');
    Route::post('/employees/edit/{id?}', 'EmployeeController@createOrUpdate')->where(['id' => '[0-9]+'])->name('save');

    Route::get('/employees/delete/{id}', 'EmployeeController@delete')->where(['id' => '[0-9]+'])->name('delete');

    Route::get('/employees/search', 'EmployeeController@search')->name('filterEmployees');
});
