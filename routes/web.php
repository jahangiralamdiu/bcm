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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/summary', 'HomeController@summary');

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'expenses' => 'ExpenseController',
        'deposits' => 'DepositController',
        'products' => 'ProductController',
        'product-types' => 'ProductTypeController',
        'users' => 'Auth\UserController',
    ]);

    Route::get('/roles', 'RoleController@index');
    Route::get('/deposits-sum', 'DepositController@depositByUser');
    Route::get('/expense-status/{id}/{status}', 'ExpenseController@updateStatus');
});
