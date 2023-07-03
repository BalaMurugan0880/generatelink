<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected $fillable = [
        'id','source_id', 'url'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
