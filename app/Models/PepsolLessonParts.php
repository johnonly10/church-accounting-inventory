<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolLessonParts extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_lesson_id',
        'part_key',
    ];

    public function lesson()
    {
        return $this->belongsTo(PepsolLesson::class);
    }

    public function blocks()
    {
        return $this->hasMany(PepsolLessonBlock::class);
    }
}
