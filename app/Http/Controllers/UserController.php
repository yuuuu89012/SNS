<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(Request $request,$id){
        $user = User::find($id);
        $user_flg=$request->path();
        $user_flg=preg_replace('/[^0-1000]/','',$user_flg);
        return view('user.show',['user'=>$user]);
    }

    public function follow(User $user)
    {
        $follower =auth()->user();
        $is_following=$fallower->isFollowing($user->id);
        if($is_following){
            $follower->stopFollowing($user->id);
            return back();
        }
    }

    public function  unfollow(User $user){
        $follower = auth()->user();
        $is_following=$follower->isFollowing($user->id);
        if($is_following){
            $follower->unfollow($user->id);
            return back();
        }
    }
}
