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

    public function checkin($id)
    {
        $vehicle = $this->vehicleService->checkin($id);
        return $vehicle;
    }

    public function checkout($id)
    {
        $vehicle = $this->vehicleService->checkout($id);
        return $vehicle;
    }


    public function checkinVisitors(Request $request)
    {
        // $vehicles = $request->vehicles;
        // $vehicles = json_decode($vehicles);
        // $vehicles = $this->vehicleService->checkinVisitors($vehicles);
        // return $vehicles;
    }
}
