<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'plate' => 'B1234XY',
            'brand' => 'Toyota',
            'color' => 'Black',
            'type_id' => 1,
        ]);

        Vehicle::create([
            'plate' => 'C1234AB',
            'brand' => 'Honda',
            'color' => 'White',
            'type_id' => 2,
        ]);

        Vehicle::create([
            'plate' => 'X1234AB',
            'brand' => 'Mazda',
            'color' => 'Red',
            'type_id' => 3,
        ]);
    }
}
