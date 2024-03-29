<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        @csrf
        <div>
            <h3 class="title">
                {{ $post->title }}
            </h3>
        </div>
        @if($post->image_url)
        <div>
            <img src="{{ $post->image_url }}" alt="画像が投稿されていません。"/>
        </div>
        @endif
        <div class="content">
            <div class="content__post">
                <p>{{ $post->body }}</p>    
            </div>
            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
            @if ($post->likes->contains('user_id', Auth::id()))
                <form action="{{ route('likes.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">いいね解除</button>
                </form>
            @else
                <form action="{{ route('likes.store', $post) }}" method="POST">
                    @csrf
                    <button type="submit">いいね</button>
                </form>
            @endif
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">投稿内容の編集</a></div>
        <div class="comment"><a href="/posts/{{ $post->id }}/comments/create">コメントの投稿</a></div
        @foreach ($comments as $comment)
            @csrf
            <div class="comments">
                {{$comment->body}}
            </div>
            <div class="edit">
                <a href="/posts/{{ $post_id }}/comments/{{ $comment->id }}/edit">コメントの編集</a>
            </div>
            <form action="/posts/{{ $post_id }}/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteComment({{ $comment->id }})">コメントの削除</button> 
            </form>
        @endforeach
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    <script>
    function deleteComment(id) {
        'use strict'
        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
    </script>
</html>