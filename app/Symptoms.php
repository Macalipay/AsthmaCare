<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    //
    protected $fillable = [
        'name',
        'description'
    ];
}
