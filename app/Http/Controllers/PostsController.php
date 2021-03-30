<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;


class PostsController extends Controller
{
    //
    public function index()
    {
        // $posts = Post::orderBy('created_at','desc')->get();
        $posts = Post::select('posts.id as id','posts.title as title','posts.body as body','posts.created_at as created_at', 'users.name as name')->leftJoin('users','posts.user_id','=','users.id')->orderBy('posts.created_at','desc')->get();
        // dd($posts);
        return view('posts.index',['posts' => $posts]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(Request $request)
    {
        $params = $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:50',
            'body' => 'required|max: 800',
        ]);

        Post::create($params);

        return redirect()->route('posts.index');
    }
    
    public function show($id) {
        $post = Post::findOrFail($id);
        $comments = Comment::select('comments.comment as comment','comments.created_at','users.name as name')->leftJoin('users','comments.user_id','=','users.id')->where('comments.post_id',$id)->orderBy('comments.created_at','desc')->get();
        // dd($comments);
        return view('posts.show',[
            'post' => $post,
            'comments' => $comments,
            ]);
    }
    
    // public function show($id) {
    //     $post = Post::findOrFail($id);
        
    //     return view('posts.show', [
    //         'post' => $post,
    //         ]);
    // }
    
    public function edit($id) {
        $post = Post::findOrFail($id);
        
        return view('posts.edit', [
            'post' => $post,
            ]);
    }
    
    public function update($id, Request $request) {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:800',
            ]);
            
        $post = Post::findOrFail($id);
        $post->fill($params)->save();
        
        return redirect()->route('posts.show', ['id' => $id]);
    }
    
    public function destroy($id) {
        $post = Post::findOrFail($id);
        
        \DB::transaction(function() use ($post){
            $post->comments()->delete();
            $post->delete();
        });
        
        return redirect()->route('posts.index');
    }

}
