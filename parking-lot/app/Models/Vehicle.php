<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'brand',
        'color',
        'type_id',
    ];


    public function type()
    {
        return $this->belongsTo(TypeVehicle::class);
    }
}
