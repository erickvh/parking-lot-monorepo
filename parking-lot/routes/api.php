<?php

use App\Http\Controllers\Parking\ParkingController;
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
});

Route::prefix('parking')->group(function () {
    Route::get('/{id}/checkin', [ParkingController::class, 'checkin']);
    Route::get('/{id}/checkout', [ParkingController::class, 'checkout']);
    Route::post('/checkin-visitor', [ParkingController::class, 'checkinVisitor']);
    Route::post('/checkout-visitor', [ParkingController::class, 'checkoutVisitor']);
});
