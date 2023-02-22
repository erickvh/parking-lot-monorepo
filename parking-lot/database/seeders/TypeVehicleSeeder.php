<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeVehicle::create([
            'name' => 'Offical Vehicle',
            'description' => 'This is a official vehicle that can park in the parking lot',
            'payment_rules' => 'as_official',
        ]);

        TypeVehicle::create([
            'name' => 'Resident Vehicle',
            'description' => 'This is a resident vehicle that can park in the parking lot (monthly payment)',
            'payment_rules' => 'as_resident',
        ]);

        TypeVehicle::create([
            'name' => 'Visitor Vehicle',
            'description' => 'This is a visitor vehicle that can park in the parking lot (pay as you go)',
            'payment_rules' => 'as_visitor',
        ]);
    }
}
