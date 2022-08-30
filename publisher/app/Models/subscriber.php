<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'topic'
    ];

    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
