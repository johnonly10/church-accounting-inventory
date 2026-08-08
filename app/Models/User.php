<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\PepsolCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'department_id',
        'leader_id',
        'role_id',
        'ministry_id',
        'position_id',
        'pepsol_type_id',
        'name',
        'path',
        'email',
        'password',
        'roletype'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leader()
    {
        return $this->belongsTo(Leader::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function pepsolCategory()
    {
        return $this->hasMany(PepsolCategory::class);
    }

    public function pepsolType()
    {
        return $this->belongsTo(PepsolType::class, 'pepsol_type_id');
    }

    public function completedLessons()
    {
        return $this->belongsToMany(PepsolLesson::class, 'pepsol_user_lesson_progress')
            ->withPivot('completed', 'completed_at')
            ->withTimestamps();
    }

    public function hasCompletedLesson($lessonId)
    {
        return $this->completedLessons()
            ->where('pepsol_lesson_id', $lessonId)
            ->wherePivot('completed', true)
            ->exists();
    }
}
