<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Comment_edit</title>
    </head>
       <body>
        <h1 class="title">コメントの編集</h1>
        <div class="content">
            <form action="/posts/{{ $post_id }}/comments/{{ $comment->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__body'>
                    <h2>本文</h2>
                    <input type='text' name='comment[body]' value="{{ $comment->body }}">
                </div>
                <input type="submit" value="更新">
            </form>
        </div>
    </body>