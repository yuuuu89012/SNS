<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $post = new Post();

        if ($file = $request->image) {
            $fileMame=time() . $file->getClientOriginalName();
            $target_path=public_path('uploads/');
            $file->move($target_path,$fileMame);
        }else{
            $fileMame=null;
        }

        $post->title=$request->input('title');
        $post->image=$fileName;
        $post->description=$request->input('description');
        $post->user_id=Auth::id();

        $post->save();

        return view('post.index');
    }
}
