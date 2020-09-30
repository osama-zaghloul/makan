<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class member extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'name','lastname', 'phone','address','password','registercode','user_hash','district'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

