<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'label',
        'position_id',
        'is_active',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
