<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\services\ParkingService;;

use Illuminate\Http\Request;


class ParkingController extends Controller
{
    private $parkingService;
    public function __construct()
    {
        $this->parkingService = new ParkingService();
    }
    public function checkin(Request $request)
    {
        $message = $this->parkingService->checkinVehicle($request);
        return response()->json($message, 200);
    }

    public function checkout(Request $request)
    {
        $vehicle = $this->parkingService->checkoutVehicle($request);
        return $vehicle;
    }

    public function getParkingInstancesByPlate(Request $request)
    {

        if (!$request->plate) return response()->json(["message" => "plate is required"], 400);

        $parkingInstances = $this->parkingService->getParkingInstancesByPlate($request->plate);
        return $parkingInstances;
    }

    public function getParkingInstances()
    {
        $parkingInstances = $this->parkingService->getParkingInstances();
        return $parkingInstances;
    }


    public function updateParkingInstance($id)
    {
        $parkingInstances = $this->parkingService->updateParkingInstance($id);
        return $parkingInstances;
    }
}
