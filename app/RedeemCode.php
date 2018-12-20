<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedeemCode extends Model
{
    protected $table = 'redeem_code';
    protected $fillable = ['code_id', 'user_id', 'redemption_date', 'exchange_command'];
    protected $guard = ['id'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function code()
    {
    	return $this->belongsTo('App\Code');
    }
}
