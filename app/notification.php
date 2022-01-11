<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'status',
    ];

    public function user_notif()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
