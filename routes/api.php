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
Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'clicksign'], function () {
        Route::group(['prefix' => 'hooks'], function () {
            Route::post('sign', [\App\Http\Controllers\ValidateHookController::class, 'validateHooks']);
        });
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});