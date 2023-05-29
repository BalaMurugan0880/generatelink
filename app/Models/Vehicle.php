<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicle';

    protected $fillable = [
        'id', 'name'
    ];

    public function models()
    {
        return $this->hasMany(VehicleModel::class);
    }
}
