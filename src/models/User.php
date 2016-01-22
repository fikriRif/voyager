<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use App\User as LaravelUser;

class User extends LaravelUser
{
    //
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setPasswordAttribute($value){
    	$this->attributes['password'] = \Hash::make($value);
    }
}
