<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProject;
use App\Models\Project;
class UserProjectController extends Controller
{
    
    function addMember(Request $request){
        
        try{
            
            $member = new UserProject();
            $member->users_idusers = $request->users_idusers;
            $member->projects_idprojects = $request->projects_idprojects;
            
            $member->save();
            
            $project = Project::find($request->projects_idprojects);
            $project->number_members = $project->number_members + 1;
            $project->save();
            
            return response()->json(['type'=>'success','message'=>'Member added'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    function deleteMember($idUser, $idProject){
        
        try{
            
            $member = UserProject::where('users_idusers', $idUser)->where('projects_idprojects', $idProject);
            $member->delete();
            
            $project = Project::find($idProject);
            $project->number_members = $project->number_members - 1;
            $project->save();
            
            return response()->json(['type'=>'success','message'=>'Member deleted'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }

}
