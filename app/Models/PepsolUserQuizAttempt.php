<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolUserQuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pepsol_quiz_id',
        'attempt_number',
        'score',
        'total_points',
        'percentage',
        'passed',
        'started_at',
        'completed_at',
        'time_taken',
        'status',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(PepsolQuiz::class, 'pepsol_quiz_id');
    }

    public function answers()
    {
        return $this->hasMany(PepsolUserAnswer::class, 'pepsol_user_quiz_attempt_id');
    }

    public function getStatusOptions()
    {
        return [
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'abandoned' => 'Abandoned',
        ];
    }
}
