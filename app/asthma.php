<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asthma extends Model
{
    //
    protected $fillable = [
        'asthma',
        'level',
        'description',
        'symptoms_id'
    ];

    public function symptoms()
    {
        return $this->belongsTo(Symptoms::class, 'symptoms_id', 'id');
    }

}
