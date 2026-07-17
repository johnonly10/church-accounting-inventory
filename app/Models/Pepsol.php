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
        'description',
        'guidelines',
        'orientation',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(PepsolCategory::class, 'pepsol_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lessons()
    {
        return $this->hasMany(PepsolLesson::class);
    }

    public function type()
    {
        return $this->belongsTo(PepsolType::class, 'pepsol_type_id');
    }

    public static function getStatusOptions()
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
        ];
    }
}
