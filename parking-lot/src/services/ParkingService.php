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


    private function calculateInstanceOfParking($instance)
    {
        $vehicle_id = $instance->vehicle_id;
        $vehicle = Vehicle::with('type')->find($vehicle_id);

        $vehicle_price_rate = $vehicle->type->price;
        $checkin = $instance->checkin;
        $checkout = $instance->checkout;

        $diff = $checkout->diffInMinutes($checkin);

        $total = $diff * $vehicle_price_rate;

        return ["total" => $total, "minutes" => $diff];
    }




    public function checkinVehicle($request)
    {
        $message = '';

        $vehicle = Vehicle::with('type')->where('plate', $request->plate)->first();

        if (!$vehicle) {
            $request->type = 'as_visitor';
            $vehicle = $this->vehicleService->createVehicle($request);
        }

        Instance::create([
            'vehicle_id' => $vehicle->id,
            'checkin' => now()
        ]);

        $message = "success checkin $vehicle->plate as {$vehicle->type->name}";


        return [
            'message' => $message,
        ];
    }

    public function checkoutVehicle($request)
    {
        $message = '';

        $vehicle = Vehicle::with('type')->where('plate', $request->plate)->first();

        if (!$vehicle) return ["message" => "Vehicle not found"];

        $instance = Instance::where('vehicle_id', $vehicle->id)->whereNull('checkout')->first();


        if (!$instance) return ["message" => "Instance not found for this vehicle"];

        $instance->checkout = now();

        list("total" => $total, "minutes" => $minutes) = $this->calculateInstanceOfParking($instance);
        $instance->amount = $total;
        $instance->minutes = $minutes;

        $instance->save();

        $message = "success checkout $vehicle->plate as {$vehicle->type->name}, parking time: $minutes minutes";
        $message .= ($vehicle->type->payment_rules == 'as_visitor') ? ", total: $total" : '';

        return [
            'message' => $message,
        ];
    }
}
