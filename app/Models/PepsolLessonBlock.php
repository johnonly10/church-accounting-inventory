<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PepsolLessonBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_lesson_part_id',
        'body',
        'quote',
        'scripture',
        'image',
        'video',
        'file',
        'url',
    ];

    public function part()
    {
        return $this->belongsTo(PepsolLessonParts::class);
    }
}
