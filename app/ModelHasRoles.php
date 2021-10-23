<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHasRoles extends Model
{
    protected $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'id', 'model_id');
    }

}
