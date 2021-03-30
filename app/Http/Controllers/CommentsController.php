<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CommentsController extends Controller
{
    //
    // public function store(Request $request)
    // {
    //     $params = $request->validate([
    //         'post_id' => 'required|exists:posts,id',
    //         'comment' => 'required|max:300',
    //     ]);

    //     $post = Post::findOrFail($params['post_id']);
    //     $post->comments()->create($params);

    //     return redirect()->route('posts.show', ['id' => $id]);
    // }
    
    public function store(Request $request) {
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required',
            'comment' => 'required|max:300',
            ]);
        $id = $request->input('post_id');
        
        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);
        
        // return redirect()->route('posts.index');
        return redirect()->route('posts.show', ['id' => $id]);
    }

}
