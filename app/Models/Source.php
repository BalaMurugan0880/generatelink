<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';

    protected $fillable = [
        'id', 'name'
    ];

    public function media()
    {
        return $this->hasOne(Media::class);
    }

    public function link()
    {
        return $this->hasMany(Link::class);
    }
}
