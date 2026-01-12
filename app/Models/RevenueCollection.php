<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueCollection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'collection_date',
    ];

    protected $casts = [
        'collection_date' => 'datetime',
    ];
    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }
}
