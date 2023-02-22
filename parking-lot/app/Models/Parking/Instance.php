<?php

namespace App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $table = 'parking_instances';

    protected $casts = [
        'checkin' => 'datetime',
        'checkout' => 'datetime',
    ];

    protected $fillable = [
        'vehicle_id',
        'checkin',
        'checkout',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
