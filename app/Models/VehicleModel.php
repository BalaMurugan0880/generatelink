<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $table = 'vehiclemodel';

    protected $fillable = [
        'id', 'vehicle_id','name'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}