<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image',
    ];

    public function lessons()
    {
        return $this->hasMany(PepsolLesson::class, 'pepsol_name_id');
    }
}
