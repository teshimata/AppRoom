<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        //dd($post);
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post, Comment $comment)
    {
        return view('posts.show')->with(['post' => $post, 'comments' => $comment->get(), 'post_id' => $post->id, 'comment_id' => $comment->id]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}