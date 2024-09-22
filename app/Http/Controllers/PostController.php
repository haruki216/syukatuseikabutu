<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PostController extends Controller
{
    //
    public function index(Post $post){
        
        $posts = $post->getByLimit(10);
        return view("chat.post")->with(["posts"=>$posts]);
    }
    public function create(){
        return view("chat.create");
    }
    
    public function show(Post $post){
         return view("chat.show")->with(["post"=>$post]);
        
    }
    
    public function store(Request $request, Post $post)
{
   
        $post->content = $request->input('content');
      

      $path = Storage::disk('s3')->put('images', $request->file('image'));
    $post->image = Storage::disk('s3')->url($path);
   
    // $post->image = $path;
    $post->user_id = Auth::id();
    $post->save();
    return redirect('/post/posts/' . $post->id);
}
     





    public function delete(Post $post){
        $post->delete();
        return redirect('/post');
    }
    
    public function search(Request $request){
        $keyword = $request->input('keyword');

         if (!empty($keyword)){
            $posts = Post::
                where('cotent','LIKE',"%{$keyword}%")->get();
           
            }
        else {
            $posts = Post::get();
        }

        return view('chat.post', [
            'posts' => $posts,
            'keyword' => $request->keyword
        ]);
    }
}