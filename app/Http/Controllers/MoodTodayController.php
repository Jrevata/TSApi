<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoodToday;
use Carbon\Carbon;

class MoodTodayController extends Controller
{
    
    public function show($id){
        
        try{
            
            $moodToday = MoodToday::find($id);
            
            return response()->json($moodToday, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    
    public function store(Request $request){
        
        try{
            
            $mood = new MoodToday();
            
            $mood->sprints_idsprints = $request->sprints_idsprints;
            $mood->users_idusers     = $request->users_idusers;
            $mood->mood_idmood       = $request->mood_idmood;
            $mood->dedicated_iddedicated  = $request->dedicated_iddedicated;
            $mood->difficulties      = $request->difficulties;
            $mood->date_mood         = $request->date_mood;
            
            $datereal = Carbon::now()->toDateString();
            
            if($datereal != $mood->date_mood){
                return response()->json(['type'=>'incorrect', 'message'=>'Date invalid'], 400);
            }
            
            $mood->save();
            
            return response()->json(['type'=>'success', 'message'=>'MoodToday created'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function update(Request $request, $id){
        
        try{
            
            $mood = MoodToday::find($id);
            
            $mood->mood           = $request->mood;
            $mood->dedicated_time = $request->dedicated_time;
            $mood->difficulties   = $request->difficulties;
            $mood->save();
            
            return response()->json(['type'=>'success', 'message'=>'MoodToday updated'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);

        }
        
    }


    public function listMoodTodays($idsprint, $iduser){
        
        try{
            
            $moodtodays = MoodToday::where('sprints_idsprints', $idsprint)
                            ->where('users_idusers', $iduser)
                            ->get();
                            
            return response()->json($moodtodays, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);

        }
        
    }
    
}
