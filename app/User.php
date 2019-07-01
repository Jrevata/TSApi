<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    
    protected $primaryKey = 'idusers';
    
    protected $fillable = [
        'email', 'password'
    ];
    
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
