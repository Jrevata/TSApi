<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    
    protected $table = 'dailies';
    
    protected $primaryKey = 'iddailies';
    
    protected $fillable = ['sprints_idsprints', 'users_idusers', 'what_did', 'what_willdo', 'date_daily','state'];
    
}
