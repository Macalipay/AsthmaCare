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
        'patient_remarks',
        'doctor_remarks',
        'patient_id',
        'user_id',
        'link',
        'status'
    ];

    protected $table = 'appointment';
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

}
