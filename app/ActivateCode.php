<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivateCode extends Model
{
    protected $table = 'activate_code';
    protected $fillable = ['code_id', 'user_id', 'activation_date', 'command_activation'];
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
