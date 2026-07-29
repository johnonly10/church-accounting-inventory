<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_lesson_id',
        'title',
        'description',
        'instruction',
        'passing_score',
        'time_limit',
        'allow_retake',
        'max_attempts',
        'status',
    ];

    protected $casts = [
        'allow_retakes' => 'boolean',
        'passing_score' => 'integer',
        'time_limit' => 'integer',
        'max_attempts' => 'integer'
    ];

    public function lesson()
    {
        return $this->belongsTo(PepsolLesson::class, 'pepsol_lesson_id');
    }

    public function questions()
    {
        return $this->hasMany(PepsolQuestion::class, 'pepsol_quiz_id');
    }

    public function attempts()
    {
        return $this->hasMany(PepsolUserQuizAttempt::class, 'pepsol_quiz_id');
    }
    public function userAttempts()
    {
        return $this->attempts()->where('user_id', auth()->id());
    }
}
