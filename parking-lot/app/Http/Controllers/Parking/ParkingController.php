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
        $content = $this->parkingService->checkoutVehicle($request);
        if ($content['message'] == 'success') return response()->json($content, 200);

        return response()->json($content, 200);
    }

    public function getParkingInstancesByPlate(Request $request)
    {

        if (!$request->plate) return response()->json(["message" => "plate is required"], 400);

        $parkingInstances = $this->parkingService->getParkingInstancesByPlate($request->plate);

        return response()->json($parkingInstances, 200);
    }

    public function getParkingInstances()
    {
        $parkingInstances = $this->parkingService->getParkingInstances();
        return response()->json($parkingInstances, 200);
    }


    public function updateParkingInstance($id)
    {
        $parkingInstances = $this->parkingService->updateParkingInstance($id);
        return response()->json($parkingInstances, 200);
    }

    public function deleteParkingInstances()
    {
        $parkingInstances = $this->parkingService->deleteParkingInstances();
        return response()->json($parkingInstances, 200);
    }
}
