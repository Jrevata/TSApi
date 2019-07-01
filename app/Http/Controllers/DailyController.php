<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily;
use Carbon\Carbon;

class DailyController extends Controller
{
    
    public function show($id){
    
        try{
            
            $daily = Daily::find($id);
            
            return response()->json($daily, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }        
    
    public function store(Request $request){
        
        try{
            
            $daily = new Daily();
            
            $daily->sprints_idsprints = $request->sprints_idsprints;
            $daily->users_idusers     = $request->users_idusers;
            $daily->what_did          = $request->what_did;
            $daily->what_willdo       = $request->what_willdo;
            $daily->date_daily        = $request->date_daily;
            
            $datereal = Carbon::now()->toDateString();
            
            
            if($datereal!=$daily->date_daily){
                return response()->json(['type'=>'incorrect', 'message'=>'Date invalid'], 400);
            }
            
            $daily->save();
            
            return response()->json(['type'=>'success', 'message'=>'Daily created'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function update(Request $request, $id){
        
        
        try{
            
            $daily = Daily::find($id);
            
            $daily->what_did          = $request->what_did;
            $daily->what_willdo       = $request->what_willdo;
            
            $daily->save();
            
            return response()->json(['type'=>'success', 'message'=>'Daily updated'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    
    public function listDailies($idsprint, $iduser){
        
        try{
            
            $dailies = Daily::where('sprints_idsprints', $idsprint)
                            ->where('users_idusers', $iduser)
                            ->get();
                            
            return response()->json($dailies, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);

        }
        
    } 
}
