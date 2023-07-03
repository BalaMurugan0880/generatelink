<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'id','source_id', 'name'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
