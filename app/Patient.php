<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'asthma_id',
        'asthma_level',
        'gender',
        'birthday',
        'contact',
        'email'
    ];

    protected $table = 'patients';

    public function asthma()
    {
        return $this->belongsTo(Asthma::class, 'asthma_id', 'id');
    }
}
