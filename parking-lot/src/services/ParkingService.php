<?php

namespace App\services;

use App\Models\Parking\Instance;
use App\Models\Vehicle;
use App\services\VehicleService;

class ParkingService
{
    private $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService();
    }

    public function checkin($id)
    {
        $vehicle = Vehicle::find($id);

        return $vehicle;
    }



    public function checkout($id)
    {
        $vehicle = Vehicle::find($id);

        return $vehicle;
    }


    public function checkinVisitor($request)
    {
        $message = '';

        $vehicle = Vehicle::with('type')->where('plate', $request->plate)->first();


        if ($vehicle && $vehicle->type->payment_rules != 'as_visitor') return ["message" => "It's not a visitor vehicle"];


        if (!$vehicle) {
            $request->type = 'as_visitor';
            $vehicle = $this->vehicleService->createVehicle($request);
        }

        Instance::create([
            'vehicle_id' => $vehicle->id,
            'checkin' => now()
        ]);

        $message = "success checkin $vehicle->plate as visitor";

        return [
            'message' => $message,
        ];
    }

    private function calculateInstanceOfParking($instance)
    {
        $vehicle_id = $instance->vehicle_id;
        $vehicle = Vehicle::with('type')->find($vehicle_id);

        $vehicle_price_rate = $vehicle->type->price;
        $checkin = $instance->checkin;
        $checkout = $instance->checkout;

        $diff = $checkout->diffInMinutes($checkin);

        $total = $diff * $vehicle_price_rate;

        return $total;
    }


    public function checkoutVisitor($request)
    {
        $message = '';

        $vehicle = Vehicle::with('type')->where('plate', $request->plate)->first();

        if ($vehicle && $vehicle->type->payment_rules != 'as_visitor') return ["message" => "It's not a visitor vehicle"];

        if (!$vehicle) return ["message" => "Vehicle not found"];

        $instance = Instance::where('vehicle_id', $vehicle->id)->whereNull('checkout')->first();


        if (!$instance) return ["message" => "Instance not found for this vehicle"];

        $instance->checkout = now();

        $total = $this->calculateInstanceOfParking($instance);

        $instance->amount = $total;

        $instance->save();
        $message = "success checkout $vehicle->plate as visitor";

        return [
            'message' => $message,
        ];
    }
}
