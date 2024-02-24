<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Room</title>
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h2>タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                
                <div class="image1">
                    <h2>画像</h2>
                    <input type="file" name="post[image1]" value="{{ $post->image1 }}" placeholder="画像を挿入する。" accept="image/png,image/jpeg,image/gif"/>
                </div>
                
                <div class="link1">
                    <input type="text" name="post[link1]"  value="{{ $post->link1 }}" placeholder="リンクを貼り付ける">
                </div>
                
                <div class='content__body'>
                    <h2>本文</h2>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                <input type="submit" value="更新">
            </form>
        </div>
    </body>
</html>