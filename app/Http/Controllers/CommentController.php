<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function index(Comment $comment)
    {
        return view('comments.index')->with(['comments' => $comment->get()]);
    }

    public function create(Post $post)
    {
        return view('comments.create')->with(['post_id' => $post->id]);
    }

    public function store(Comment $comment, Post $post, Request $request)
    {
        //dd($post->id);
        $input = $request['comment'];
        $input['user_id'] = Auth::id();
        $input['post_id'] = $post->id;
        $comment->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

    public function edit(Post $post, Comment $comment)
    {
        //dd($comment);
        return view('comments.edit')->with(['post_id' => $post->id, 'comment' => $comment]);
    }
    
    public function update(Post $post, Comment $comment, Request $request)
    {
        $input_comment = $request['comment'];
        $comment->fill($input_comment)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
        public function delete(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect('/posts/' . $post->id);
    }

}