<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    protected $fillable = [
        'title',
        'details',
        'status',
        'user_id'
    ];
}
