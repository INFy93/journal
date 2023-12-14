<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['auth'], 'prefix' => 'v1'], function () {
Route::apiResource('records', \App\Http\Controllers\Api\RecordsController::class);

Route::apiResource('devices', \App\Http\Controllers\Api\DeviceController::class);
Route::get('device/{node_id}', [\App\Http\Controllers\Api\DeviceController::class, 'getDevices']);

Route::apiResource('nodes', \App\Http\Controllers\Api\NodeController::class);
Route::get('node/{city_id}', [\App\Http\Controllers\Api\NodeController::class, 'getNode']);

Route::apiResource('users', \App\Http\Controllers\Api\UsersController::class);

Route::apiResource('stuff', \App\Http\Controllers\Api\StuffController::class);

Route::apiResource('city', \App\Http\Controllers\Api\CityController::class);
});
