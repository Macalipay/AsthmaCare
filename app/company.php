<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $fillable = [
        'company_name',
        'address',
        'city',
        'contact',
        'status',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
