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
    return redirect('employee');
});

Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/employee', 'EmployeeController@index')->name('employee.index');
    Route::get('/employee/ajax', 'EmployeeController@ajax')->name('employee.ajax');
    Route::post('/employee/store', 'EmployeeController@store')->name('employee.store');
    Route::get('/employee/view/{id}', 'EmployeeController@view')->name('employee.view');
});
