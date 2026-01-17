<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'payment_method',
        'revenue_type_id',
        'name',
        'revenue_collection_id',
        'beneficiary',
    ];

    public function revenueCollection()
    {
        return $this->belongsTo(RevenueCollection::class);
    }

    public function revenueCashCount()
    {
        return $this->hasMany(RevenueCashCount::class);
    }

    public function revenueType()
    {
        return $this->belongsTo(RevenueType::class);
    }
}
