<?php

use App\Http\Controllers\Vehicle\VehicleController;
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

Route::prefix('vehicle')->group(function () {
    Route::post('/', [VehicleController::class, 'createVehicle']);
    Route::get('/{id}/checkin', [VehicleController::class, 'checkin']);
    Route::get('/{id}/checkout', [VehicleController::class, 'checkout']);
});

Route::post('/checkin-visitor', [VehicleController::class, 'checkinVisitor']);
