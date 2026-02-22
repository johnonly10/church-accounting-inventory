<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image_path',
        'start_at',
        'ends_at',
        'location'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'ends_at'  => 'datetime',
    ];
}
