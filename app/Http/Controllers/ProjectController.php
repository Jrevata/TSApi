<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    
    public function index(){
        
        try{
        
            $projects = Project::all()->where('state', 1);
            
            return response()->json($projects, 200);
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
        }    
    }
    
    public function show($id){
        
        try{
        
            $project = Project::find($id);
            
            if($project == null){
                return response()->json(['type'=>'error', 'message'=>'Project_not_found'], 400);
            }
            
            return response()->json($project, 200);
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
        } 
        
    }
    
    public function store(Request $request){
        
        try{
            $project = new Project();
            
            $project->project_name = $request->get('project_name');
            $project->start_date   = $request->get('start_date');
            $project->end_date     = $request->get('end_date');
            
            $project->save();
            
            return response()->json(['type'=>'success', 'message'=>'Project created'], 200);
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function update(Request $request, $id){
         
        try{
            $project = Project::find($id);
            
            $project->project_name = $request->get('project_name');
            $project->start_date   = $request->get('start_date');
            $project->end_date     = $request->get('end_date');
            
            $project->save();
            
            return response()->json(['type'=>'success', 'message'=>'Project updated'], 200);
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function destroy($id){
        
        try{
            $project = Project::find($id);
            
            $project->state = 0;
            
            $project->save();
            
            return response()->json(['type'=>'success', 'message'=>'Project Archived'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function getUsersByProject($id){
        
        try{
            
            $users = Project::find($id)->users;
            
            return response()->json($users, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    
    
}
