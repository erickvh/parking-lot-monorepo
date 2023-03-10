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

Route::prefix('vehicle')->middleware(['auth.ms'])->group(function () {
    Route::post('/', [VehicleController::class, 'createVehicle']);
    Route::get('/', [VehicleController::class, 'getVehicle']);
    Route::get('/by-type', [VehicleController::class, 'getVehiclesByType']);
});

Route::prefix('parking')->middleware(['auth.ms'])->group(function () {
    Route::post('/checkin', [ParkingController::class, 'checkin']);
    Route::post('/checkout', [ParkingController::class, 'checkout']);
    Route::get('/instances-by-plate', [ParkingController::class, 'getParkingInstancesByPlate']);
    Route::get('/instances', [ParkingController::class, 'getParkingInstances']);
    Route::delete('instances', [ParkingController::class, 'deleteParkingInstances']);
    Route::put('instances/{id}/paid', [ParkingController::class, 'updateParkingInstance']);
});
