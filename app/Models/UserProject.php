<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $table = 'users_has_projects';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'users_idusers', 'projects_idprojects'
    ];
    
    public $timestamps = false;
}
