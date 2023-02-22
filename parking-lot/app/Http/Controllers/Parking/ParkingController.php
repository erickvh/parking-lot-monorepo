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
    public function checkin($id)
    {
        $vehicle = $this->parkingService->checkin($id);
        return $vehicle;
    }

    public function checkout($id)
    {
        $vehicle = $this->parkingService->checkout($id);
        return $vehicle;
    }


    public function checkinVisitor(Request $request)
    {

        $vehicle = $this->parkingService->checkinVisitor($request);

        return $vehicle;
    }

    public function checkoutVisitor(Request $request)
    {
        $vehicle = $this->parkingService->checkoutVisitor($request);

        return $vehicle;
    }
}
