<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;
use App\Models\Project;

class SprintController extends Controller
{
   
   public function store(Request $request){
       
       try{
           
           $sprint = new Sprint();
           $sprint->projects_idprojects = $request->projects_idprojects;
           $sprint->sprint_name = $request->sprint_name;
           $sprint->sprint_goal = $request->sprint_goal;
           $sprint->start_date  = $request->start_date;
           $sprint->end_date    = $request->end_date;
           
           $sprint->save();
            
           $project = Project::find($request->projects_idprojects);
           $project->number_sprints = $project->number_sprints + 1;
           $project->save();
           
           return response()->json(['type'=>'success', 'message'=>'Sprint created'], 200);
           
       }catch(\Exception $e){
           
           return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
           
       }
       
   }
   
   public function update(Request $request, $id){
       
       try{
           
           $sprint = Sprint::find($id);
           $sprint->sprint_name = $request->sprint_name;
           $sprint->sprint_goal = $request->sprint_goal;
           $sprint->start_date  = $request->start_date;
           $sprint->end_date    = $request->end_date;
           
           $sprint->save();
           
           return response()->json(['type'=>'success', 'message'=>'Sprint updated'], 200);
           
       }catch(\Exception $e){
           
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);

           
       }
       
   }
   
   
   public function getSprintsbyProject($id){
        
        try{
            
        
            $sprints = Project::find($id)->sprints;
            
            return response()->json($sprints, 200);
        
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function destroy($id){
        try{
            $sprint = Sprint::find($id);
            
            $sprint->state = 0;
            
            $sprint->save();
            
            return response()->json(['type'=>'success', 'message'=>'Sprint Archived'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
    }
    
   /* public function getSprintByDate($date){
        
        try{
        
            $sprint = Sprint;
        
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
   }
     */   
    
    
    
   
}
