<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function lessons()
    {
        return $this->hasMany(PepsolLesson::class, 'pepsol_topic_id');
    }
}
