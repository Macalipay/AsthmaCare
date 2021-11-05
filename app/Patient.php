<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name',
        'description'
    ];

    protected $table = 'types_of_asthma';
}
