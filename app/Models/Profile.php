<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'designation',
        'phone_number',
        'dob',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
