<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $primaryKey = 'idcomments';
    
    protected $fillable = ['users_idusers', 'sprints_idsprints', 'message'];
}
