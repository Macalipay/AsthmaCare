<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asthma extends Model
{
    //
    protected $fillable = [
        'asthma',
        'description',
        'symptoms_id'
    ];

}
