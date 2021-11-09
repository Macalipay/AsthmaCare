<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'date',
        'time',
        'doctor_id',
        'remarks',
        'patient_id',
        'user_id'
    ];

    protected $table = 'appointment';
}
