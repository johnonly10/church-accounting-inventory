<?php

namespace App\Models;

use App\Models\PepsolQuiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_quiz_id',
        'question_text',
        'explanation',
        'media',
        'reference',
        'points',
        'sort_order',
    ];

    public function quiz()
    {
        return $this->belongTo(PepsolQuiz::class, 'pepsol_quiz_id');
    }

    public function options()
    {
        return $this->hasMany(PepsolQuestionOption::class, 'pepsol_question_id')->orderBy('sort_order');
    }

    public function correctOption()
    {
        return $this->hasOne(PepsolQuestionOption::class, 'pepsol_question_id')->where('is_correct', true);
    }

    public function userAnswers()
    {
        return $this->hasMany(PepsolUserAnswer::class, 'pepsol_question_id');
    }
}
