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

Route::post('login', 'LoginController@login')->name('login');

Route::middleware('auth:api','scope:creator')->group(function () {
    Route::get('logout', 'LoginController@logout');
    
    Route::get('overtimes', 'OvetimeController@index');
    Route::post('overtimes', 'OvertimeController@store');
    Route::put('overtimes/{overtime}', 'OvertimeController@update');
});
