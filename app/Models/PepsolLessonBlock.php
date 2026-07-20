<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PepsolLessonBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_lesson_part_id',
        'block_type',
        'content',
        'reference',
        'media',
        'sort_order',
    ];

    public function part()
    {
        return $this->belongsTo(PepsolLessonParts::class, 'pepsol_lesson_part_id');
    }
}
