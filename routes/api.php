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
    Route::post('login', 'LoginController@login')->name('login');

    Route::middleware(['auth:api', 'scope:create'])->group(function(){
        Route::get('logout', 'LoginController@logout');
        Route::get('names', 'OvertimeController@names');
        Route::post('overtimes', 'OvertimeController@store');
    });

    Route::middleware(['auth:api', 'scope:approve'])->group(function(){
        Route::get('overtimes', 'OvertimeController@index');
        Route::put('overtimes/{overtime}', 'OvertimeController@update');
    });
});
