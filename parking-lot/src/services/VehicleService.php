<?php

namespace App\services;

use App\Models\TypeVehicle;
use App\Models\Vehicle;

class VehicleService
{
    public function createVehicle($request)
    {
        $type = TypeVehicle::where('payment_rules', $request->type)->first();

        $vehicle = Vehicle::create([
            'plate' => $request->plate,
            'brand' => $request->brand,
            'color' => $request->color,
            'type_id' => $type->id,
        ]);

        return $vehicle;
    }
}
