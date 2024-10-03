<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index()
    {
        $posts=DB::table('users')
          ->join('posts', 'users.id', '=', 'posts.user_id')
          ->select('posts.title','posts.image','posts.description','posts.user_id','posts.id','users.name','users.id as user_id','posts.category')
          ->get();
        #$posts = Post::all(); 

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
        $post->category = $request->input('category');
        $post->user_id=Auth::id();

        $post->save();

        return redirect()->route('post.index');
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
            $post->image = $fileName;
        }
        else{
            $fileName=null;
        }
        $post->title=$request->input('title');
        $post->image=$fileName;
        $post->description=$request->input('description');
        $post->category = $request->input('category');
        $post->save();

        return redirect('post/index');
    }

    public function destroy($id){
        $post=Post::find($id);
        $post->delete();
        return  redirect('post/index');
    }
    public function show($id){
        $post=Post::find($id);
        return  view('posts.show', ['post' => $post]);
    }
}
 