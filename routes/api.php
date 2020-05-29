<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::namespace('User')->group(function () {
    Route::post('login', 'LoginController@login');

    Route::middleware(['auth:api', 'scope:create'])->group(function () {
        Route::get('logout', 'LoginController@logout');
        Route::get('users', 'UserController@index');
        Route::post('store', 'OvertimeController@store');
    });
    Route::middleware(['auth:api', 'scope:approve'])->group(function () {
        Route::get('overtimes', 'OvertimeController@index');
        Route::get('approve', 'OvertimeController@listApprove');
        Route::put('overtimes/{id}', 'OvertimeController@update');
    });
});
Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::post('login', 'LoginController@login');

    Route::middleware(['auth:api', 'scope:admin'])->group(function () {
        Route::get('logout', 'LoginController@logout');

        // Overtimes
        Route::get('overtimes/{status}', 'OvertimeController@index');
        Route::post('store', 'OvertimeController@store');
        Route::put('update/{id}', 'OvertimeController@update');

        // Users
        Route::get('users', 'UserController@index');
        Route::put('users/{id}/toggle-status', 'UserController@toggleStatus');
        Route::put('users/{id}/toggle-role', 'UserController@toggleRole');
    });
});
