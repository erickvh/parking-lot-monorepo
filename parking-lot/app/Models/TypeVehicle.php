<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'float',
    ];


    protected $fillable = [
        'name',
        'payment_rules',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
