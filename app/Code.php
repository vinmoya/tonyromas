<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';
    protected $fillable = ['expire', 'value', 'code', 'state'];
    protected $guard = ['id'];

    public function activate_codes()
    {
    	return $this->belongsTo('App\ActivateCode');
    }

    public function redeem_codes()
    {
    	return $this->belongsTo('App\RedeemCode');
    }
}
