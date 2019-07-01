<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    protected $table = 'users';
    
    protected $primaryKey = 'idusers';
    
    protected $fillable = [
        'email', 'password', 'remember_token','image' , 'familyName', 'givenName', 'phone','role','state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
    
    public function projects(){
        
        return $this->belongsToMany('App\Models\Project','users_has_projects', 'users_idusers', 'projects_idprojects')->where('state', 1);
        
    }
    
}
