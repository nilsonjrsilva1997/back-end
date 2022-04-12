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
    Route::group(['prefix' => 'ticket'], function () {
        Route::get('/', [\App\Http\Controllers\TicketController::class, 'index']);
        Route::get('{id}/', [\App\Http\Controllers\TicketController::class, 'show']);
        Route::post('/', [\App\Http\Controllers\TicketController::class, 'create']);
        Route::put('/{id}', [\App\Http\Controllers\TicketController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\TicketController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});     