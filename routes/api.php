<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\VehicleController;


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

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'check']);

Route::get('/user/cash', [CashController::class, 'getUserCash'])->middleware('auth:sanctum');
Route::post('/user/remove-cash', [CashController::class, 'removeUserCash'])->middleware('auth:sanctum');
Route::post('/user/buy-vehicle', [VehicleController::class, 'buyVehicle'])->middleware('auth:sanctum');
Route::get('/user/vehicles', [VehicleController::class, 'getUserVehicles'])->middleware('auth:sanctum');
Route::get('/vehicle', [VehicleController::class, 'getVehicles']);