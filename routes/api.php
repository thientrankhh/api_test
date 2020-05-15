<?php

use Illuminate\Http\Request;
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
    
    Route::middleware(['auth:api', 'scope:create'])->group(function(){
        Route::get('logout', 'LoginController@logout');
        Route::get('users', 'UserController@index');
        Route::post('overtimes', 'OvertimeController@store');
    });
    Route::middleware(['auth:api', 'scope:approve'])->group(function(){
        Route::get('overtimes', 'OvertimeController@index');
        Route::put('overtimes/{id}', 'OvertimeController@update');
    });
});
Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::post('login', 'LoginController@login');

    Route::middleware(['auth:api', 'scope:admin'])->group(function(){
        Route::get('logout', 'LoginController@logout');
        
        // Overtimes
        Route::get('overtimes', 'OvertimeController@index');
        Route::post('overtimes', 'OvertimeController@store');
        Route::put('overtimes/{id}', 'OvertimeController@update');

        // Users
        Route::get('users', 'UserController@index');
        Route::put('users/{id}/toggle', 'UserController@toggle');
        Route::put('users/{id}/set-role', 'UserController@set');
    });
});
