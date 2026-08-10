<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'reply_message',
        'replied_at',
        'replied_by'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
