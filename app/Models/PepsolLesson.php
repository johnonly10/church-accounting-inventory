<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PepsolLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_id',
        'title',
        'subtitle',
        'summary',
        'image',
    ];

    public function pepsol()
    {
        return $this->belongsTo(Pepsol::class);
    }

    public function parts()
    {
        return $this->hasMany(PepsolLessonParts::class);
    }
}
