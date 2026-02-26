<?php

namespace App\Models;

use App\Models\PepsolCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pepsol extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pepsol_category_id',
        'pepsol_type_id',
        'created_by',
        'name',
        'description',
        'rules',
        'orientation',
    ];

    public function category()
    {
        return $this->belongsTo(PepsolCategory::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(PepsolLesson::class);
    }

    public function type()
    {
        return $this->belongsTo(PepsolType::class);
    }
}
