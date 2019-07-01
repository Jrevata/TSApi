<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class UserController extends Controller
{
    
    public function index(){
        
        try{
            
            $users = User::all()->where('state', 1);
            
            return response()->json($users, 200);
             
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function showUser(Request $request){
        
        try{
            
            $user = User::where('email',$request->email)->firstOrFail();
            
            return response()->json($user, 200);
             
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    
    public function store(Request $request){
        
        try{
            
            $user = new User();
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            $user->givenName    = $request->givenName;
            $user->familyName   = $request->familyName;
            $user->phone        = $request->phone;
            $user->role         = $request->role;
            
            
            
            $user->save();
            
            return response()->json(['type' => 'success', 'message' => 'User created'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function updateUserbyAdmin(Request $request, $id){
        
        try{
            
            $user = User::find($id);
            
            $user->givenName  = $request->get('givenName');
            $user->familyName = $request->get('familyName');
            $user->email      = $request->get('email');
            $user->role       = $request->get('role');
            
            $user->save();
            
            return response()->json(['type'=>'success', 'message'=>'User Update'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function update(Request $request, $id){
        try{
            
            $user = User::find($id);
            
            $user->givenName  = $request->get('givenName');
            $user->familyName = $request->get('familyName');
            $user->phone      = $request->get('phone');
            
            if($request->hasFile('image') && $request->file('image')->isValid()){
                
                $image = $request->file('image');
            
                $extensionName = UserController::getFileExtension($request->file('image')->getClientOriginalName());
                
                
                if($user->image == null){
                    $name = UserController::createNameValidForDate().".".$extensionName;
                    $user->image = $name;
                }else{
                    $filePath = public_path()."/images/".$user->image;
                    
                    if(File::exists($filePath)){
                        
                        File::delete($filePath);
                    }
                    
                    $name = UserController::createNameValidForDate().".".$extensionName;
                    $user->image = $name;
                }    
                Storage::disk('images')->put($name, File::get($image));
                
            }
            
            $user->save();
            
            return response()->json(['type'=>'success', 'message'=>$user->image], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
    }
    
    
    public function destroy($id){
        try{
            $user = User::find($id);
            
            $user->state = 0;
            
            $user->save();
            
            return response()->json(['type'=>'success', 'message'=>'User Archived'], 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
    }
    
    public function getProjectsByUser($id){
        
        try{
            
            $projects = User::find($id)->projects;
            
            return response()->json($projects, 200);
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function setToken(Request $request, $id){
        
        try{
            
            $user = User::find($id);
            
            $user->remember_token = $request->get('remember_token');
            
            
            return response()->json(['type'=>'success', 'message'=>'token modificated'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function deleteToken($id){
        
        try{
            
            $user = User::find($id);
            
            $user->remember_token = null;
            
            
            return response()->json(['type'=>'success', 'message'=>'token deleted'], 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    
    public function getFileExtension($file_name) {
        return substr(strrchr($file_name,'.'),1);
    }
    
    public function createNameValidForDate(){
        
        $datetime = Carbon::now()->toDateTimeString();
        
        $date1 = explode(' ',$datetime);
        $date = $date1[0];
        $time = $date1[1];
        
        $newdate = str_replace('-', '', $date);
        $newtime = str_replace(':', '', $time);
        
        return $newdate.$newtime;
        
    }
    
     
    
    
    
}
