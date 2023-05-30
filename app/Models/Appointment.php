<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'req_name', 'req_designation', 'req_contact', 'apt_date',
        'apt_time', 'pickup_location', 'pickup_lat', 'pickup_long', 'pickup_url', 'customer_name', 'customer_contact'
        , 'customer_vrn', 'vehicle_make', 'vehicle_model', 'dropoff_location', 'dropoff_lat'
        , 'dropoff_long', 'dropoff_url', 'special_notes','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
