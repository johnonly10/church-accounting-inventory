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
        'types',
        'name',
        'revenue_collection_id',
    ];

    public function revenueCollection()
    {
        return $this->belongsTo(RevenueCollection::class);
    }

    public function revenue_cash_count()
    {
        return $this->hasOne(RevenueCashCount::class);
    }
}
