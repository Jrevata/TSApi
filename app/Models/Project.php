<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    
    protected $table = 'projects';
    
    protected $primaryKey = 'idprojects';
    
    protected $fillable = ['idprojects', 'project_name', 'number_sprints', 'start_date', 'end_date', 'number_members'];
    
    public function sprints(){
        
        return $this->hasMany('App\Models\Sprint', 'projects_idprojects', 'idprojects')->where('state', 1);
        
    }
    
    public function users(){
        
        return $this->belongsToMany('App\Models\User', 'users_has_projects','projects_idprojects', 'users_idusers')->where('state', 1);
        
    }
    
}
