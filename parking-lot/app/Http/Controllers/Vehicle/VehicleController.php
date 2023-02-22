<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVehicleRequest;
use App\services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    private $vehicleService;
    public function __construct()
    {
        $this->vehicleService = new VehicleService();
    }

    public function createVehicle(CreateVehicleRequest $request)
    {
        $vehicle = $this->vehicleService->createVehicle($request);
        return response()->json(["message" => "success", "vehicle" => $vehicle], 201);
    }
}
