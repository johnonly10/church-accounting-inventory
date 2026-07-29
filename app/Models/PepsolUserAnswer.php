<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_user_quiz_attempt_id',
        'pepsol_question_id',
        'selected_option_id',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function attempt()
    {
        return $this->belongsTo(PepsolUserQuizAttempt::class, 'pepsol_user_quiz_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(PepsolQuestion::class, 'pepsol_question_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(PepsolQuestionOption::class, 'selected_option_id');
    }
}
