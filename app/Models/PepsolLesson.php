<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PepsolLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'pepsol_id',
        'pepsol_name_id',
        'pepsol_topic_id',
        'title',
        'subtitle',
        'summary',
        'image',
    ];

    public function pepsol()
    {
        return $this->belongsTo(Pepsol::class, 'pepsol_id');
    }

    public function parts()
    {
        return $this->hasMany(PepsolLessonParts::class);
    }

    public function name()
    {
        return $this->belongsTo(PepsolName::class, 'pepsol_name_id');
    }

    public function topic()
    {
        return $this->belongsTo(PepsolTopic::class, 'pepsol_topic_id');
    }

    public function quizzes()
    {
        return $this->hasMany(PepsolQuiz::class, 'pepsol_lesson_id');
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'pepsol_user_lesson_progress')
            ->withPivot('completed', 'completed_at')
            ->withTimestamps();
    }
}
