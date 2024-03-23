<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post, Like $like)
    {
        $like = New Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        return redirect('/posts/' . $post->id);
    }

    public function destroy(Post $post)
    {
        $like = Like::where('user_id', Auth::id())->where('post_id', $post->id)->first();
        if ($like) {
            $like->delete();
        }
        return redirect('/posts/' . $post->id);
    }
}