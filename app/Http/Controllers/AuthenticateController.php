<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->only("email", "password");
        
        try{
        
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'invalid credentials'], 401);
            }
        
        }catch(JWTException $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $response = compact('token');
        $response['user'] = Auth::user();
     
        
        return $response;
    
    }
    
    
    public function logout(){
        try{
            
            $token = JWTAuth::getToken(); 
            
            JWTAuth::invalidate($token);
            
            
            return response()->json(['type'=>'success' , 'message'=>'Logout success'], 200);
        
        }catch(JWTException $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
        }
        
    }
    
    public function changePassword(Request $request, $idUser){
        
        try{
            
            $user = User::select('password')->where('idusers', $idUser)->get();
            $passwordHashed = $user[0]->password;
            
            
            if (Hash::check($request->oldPassword, $passwordHashed)) {
                
                $newPassword = Hash::make($request->newPassword);
                $changeUser = User::find($idUser);
                $changeUser->password = $newPassword;
                $changeUser->save();
                
                return response()->json(['type'=>'success', 'message'=>'Password changed'], 200);
                
            }else{
                return response()->json(['type'=>'incorrect', 'message'=>'Old Password Invalid'], 400);
            }
        
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
        }
        
        
    }
}
