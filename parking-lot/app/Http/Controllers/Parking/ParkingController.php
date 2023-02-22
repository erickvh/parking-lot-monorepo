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
}
