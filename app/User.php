<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'birthday',
        'contact_no',
        'city',
        'email',
        'username',
        'company_id',
        'password',
        'status',
        'days_interval',
        'license',
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
        return $this->hasOne(ModelHasRole::class, 'model_id', 'id');
    }
    
    public function schedule()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id', 'id')->where('status', 0);
    }

    public function appointment()
    {
        return $this->hasMany(User::class, 'doctor_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(company::class, 'company_id', 'id');
    }
}
