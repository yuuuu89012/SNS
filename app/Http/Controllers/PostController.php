<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
        return view('posts.index', ['posts' => $posts]); 
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){
        $post = new Post();

        if ($file = $request->image) {
            $fileName=time() . $file->getClientOriginalName();
            $target_path=public_path('uploads/');
            $file->move($target_path,$fileName);
        }else{
            $fileName=null;
        }

        $post->title=$request->input('title');
        $post->image=$fileName;
        $post->description=$request->input('description');
        $post->user_id=Auth::id();

        $post->save();

        #return view('post.index');
    }
    public function edit($id){
        $post=Post::find($id);
        return  view('posts.edit', ['post' => $post]);
    }

    public function update(UpdatePostRequest $request,$id){
        $post=Post::find($id);
        if($file=$request->image){
            $fileName=time().$file->getClientOriginalName();
            $target_path=public_path('uploads/');
            $file->move($target_path,$fileName);
        }
        else{
            $fileName=null;
        }
        $post->title=$request->input('title');
        $post->image=$fileName;
        $post->description=$request->imput('description');
        $post->save();

        return redirect('post/index');
    }
}
 