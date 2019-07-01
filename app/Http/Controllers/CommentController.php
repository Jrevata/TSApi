<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Sprint;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Request $request){
        
        try{
            
            $comment = new Comment();
            
            $comment->sprints_idsprints = $request->sprints_idsprints;
            $comment->users_idusers     = $request->users_idusers;
            $comment->message           = $request->message;
            $comment->save();
            
            $user = User::find($comment->users_idusers);
    
            $comment->givenName = $user->givenName;
            $comment->familyName = $user->familyName;
            $comment->image  = $user->image;
            
            return response()->json($comment, 200);
            
            
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
    
    public function getCommentsBySprint($id){
    
        try{
        
            $comments = Sprint::find($id)->comments;
            
            foreach ($comments as $comment) {
    
                $user = User::find($comment->users_idusers);
    
                $comment->givenName = $user->givenName;
                $comment->familyName = $user->familyName;
                $comment->image  = $user->image;
    
            }
            
            
            return response()->json($comments, 200);
        
        }catch(\Exception $e){
            
            return response()->json(['type'=>'error', 'message'=>$e->getMessage()], 500);
            
        }
        
    }
}
