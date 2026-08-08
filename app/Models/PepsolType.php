<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PepsolType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
    ];

    public function pepsols()
    {
        return $this->hasMany(Pepsol::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
