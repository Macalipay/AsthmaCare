<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asthma extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'symptoms_id'
    ];

}
