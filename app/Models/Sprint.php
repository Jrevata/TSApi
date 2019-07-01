<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
     protected $table = 'sprints';
    
    protected $primaryKey = 'idsprints';
    
    protected $fillable = ['projects_idprojects','sprint_name', 'sprint_goal', 'start_date', 'end_date'];
    
    public function project(){
        
        return $this->belongsTo('App\Models\Project');
    
        
    }
    
    public function comments(){
        return $this->hasMany('App\Models\Comment', 'sprints_idsprints', 'idsprints' );
    }
    
}
