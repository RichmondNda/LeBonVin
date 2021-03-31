<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        
        request()->validate([
            'body' => 'required|min:10'
        ]);


        

        $post = Post::find($request->post_id);
        
        $comment = new Comment();
        $comment->body = $request->body;

        $comment->user_id = auth()->user()->id;

        $post->comments()->save($comment);



        return redirect()->back();

    }
}
