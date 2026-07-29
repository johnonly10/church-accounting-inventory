<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PepsolQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_question_id',
        'option_text',
        'is_correct',
        'media',
        'sort_order',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(PepsolQuestion::class, 'pepsol_question_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(PepsolUserAnswer::class, 'selected_option_id');
    }
}
