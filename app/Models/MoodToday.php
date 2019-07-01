<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodToday extends Model
{
    protected $table = 'moodtoday';
    
    protected $primaryKey = 'idmoodtoday';
    
    protected $fillable = ['sprints_idsprints', 'users_idusers', 'mood_idmood', 'dedicated_iddedicated', 'difficulties', 'date_mood'];
}
