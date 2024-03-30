<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostImage;
use App\Models\PostLink;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
        //dd($post);
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post, Comment $comment)
    {
        return view('posts.show')->with(['post' => $post, 'comments' => $comment->get(), 'post_id' => $post->id]);
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }

    public function store(PostRequest $request)
    {
        $newPostId = 0;
        \DB::transaction(function () use ($request, &$newPostId) {
            $post = new Post();
            $input = $request['post'];
            $input['user_id'] = Auth::id();
            $post->fill($input)->save();
            $newPostId = $post->id;
        
            // リクエストにファイルが存在する場合 
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    // 画像ファイルを保存し、そのURLを取得（クラウドダイナリーを使用）
                    $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    // 新しいPostImageモデルを作成し、関連するPostとともに保存
                    $postImage = new PostImage();
                    $postImage->post_id = $newPostId;
                    $postImage->image_url = $image_url;
                    $postImage->save();
                }
            }
        });
        
        return redirect('/posts/' . $newPostId);
    }
    
    public function edit(Post $post, Category $category)
    {
        return view('posts.edit')->with([
            'post' => $post,
            'categories' => $category->get()
        ]);
    }
    
    public function update(PostRequest $request, Post $post)
    {

        \DB::transaction(function () use ($request, $post) {
            $input = $request['post'];
            $input['user_id'] = Auth::id();
            $post->fill($input)->save();

            // リクエストにファイルが存在する場合 
            if ($request->hasFile('images')) {
                // 関連する既存の画像を削除
                foreach ($post->images as $image) {
                    
                    // 以下の対応が必要
                    // Cloudinaryから画像を削除する場合、ここでその処理を追加
                    // 例: Cloudinary::destroy($image->public_id);
        
                    // データベースから画像を削除
                    $image->delete();
                }
        
                $images = $request->file('images');
                foreach ($images as $image) {
                    // 画像ファイルを保存し、そのURLを取得（クラウドダイナリーを使用）
                    $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    // 新しいPostImageモデルを作成し、関連するPostとともに保存
                    $postImage = new PostImage();
                    $postImage->post_id = $post->id;
                    $postImage->image_url = $image_url;
                    $postImage->save();
                }
            }
        });
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}