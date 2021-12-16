<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstAid extends Model
{
    //
    protected $fillable = [
        'name',
        'asthma_id',
        'description'
    ];

    public function asthma()
    {
        return $this->belongsTo(asthma::class, 'asthma_id', 'id');
    }
}
