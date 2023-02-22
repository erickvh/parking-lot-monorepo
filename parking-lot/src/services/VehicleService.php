<?php

namespace App\services;

use App\Models\TypeVehicle;
use App\Models\Vehicle;

class VehicleService
{
    public function createVehicle($request)
    {
        $request->plate = strtoupper($request->plate);
        $type = TypeVehicle::where('payment_rules', $request->type)->first();


        $vehicle = Vehicle::create([
            'plate' => $request->plate,
            'brand' => $request->brand,
            'color' => $request->color,
            'type_id' => $type->id,
        ]);

        return $vehicle;
    }

    public function checkin($id)
    {
        $vehicle = Vehicle::find($id);

        return $vehicle;
    }

    public function checkinVisitor($request)
    {
        $message = '';

        $vehicle = Vehicle::with('type')->where('plate', $request->plate)->first();


        if ($vehicle && $vehicle->type->payment_rules != 'as_visitor') return "It's not a visitor vehicle";


        if (!$vehicle) {
            $request->type = 'as_visitor';
            $vehicle = $this->createVehicle($request);
        }



        return [
            'message' => $message,
        ];
    }

    public function checkout($id)
    {
        $vehicle = Vehicle::find($id);

        return $vehicle;
    }
}
