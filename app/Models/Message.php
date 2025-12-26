<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'messageable_id',
        'messageable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messageable()
    {
        return $this->morphTo();
    }
}
