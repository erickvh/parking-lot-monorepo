<?php

use App\Http\Controllers\PaymentController;
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

Route::prefix("payment")->middleware(['guard.auth'])->group(function () {

    Route::get("resident-debts", [PaymentController::class, "getResidentReport"]);
    Route::post("restart-month", [PaymentController::class, "restartMonth"]);
    Route::post("pay-instance-visitor/{id}", [PaymentController::class, "payInstanceVisitor"]);
});
