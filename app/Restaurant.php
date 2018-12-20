<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = ['name', 'address'];
    protected $guard = ['id'];

    public function user()
    {
    	return $this->hasOne('App\User');
    }
}
