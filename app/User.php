<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['restaurant_id', 'name', 'email', 'login', 'password'];
    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function avtivate_codes()
    {
        return $this->hasMany('App\ActivateCode');
    }

    public function redeem_codes()
    {
        return $this->hasMany('App\RedeemCode');
    }
}
