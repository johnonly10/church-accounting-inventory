<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueCashCount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'revenue_id',
        'bill_1000',
        'bill_500',
        'bill_200',
        'bill_100',
        'bill_50',
        'bill_20',
        'coin_20',
        'coin_10',
        'coin_5',
        'coin_1',
        'centimo_25',
        'centimo_10',
        'centimo_5',
        'centimo_1',
    ];

    protected $casts = [
        'revenue_id' => 'integer',

        'bill_1000' => 'integer',
        'bill_500'  => 'integer',
        'bill_200'  => 'integer',
        'bill_100'  => 'integer',
        'bill_50'   => 'integer',
        'bill_20'   => 'integer',

        'coin_20' => 'integer',
        'coin_10' => 'integer',
        'coin_5'  => 'integer',
        'coin_1'  => 'integer',

        'centimo_25' => 'integer',
        'centimo_10' => 'integer',
        'centimo_5'  => 'integer',
        'centimo_1'  => 'integer',
    ];

    public function revenues()
    {
        return $this->belongsTo(Revenue::class);
    }
}
