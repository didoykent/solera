<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
class Mega extends Model implements AuthenticatableContract
{

    use Authenticatable;


    protected $table = 'mega';


    protected $fillable = ['email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
