<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Comment</title>
    </head>
    <body>
        <h2>コメント</h1>
        <form action="/posts/{post}{{ $post_id }}/comments" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="body">
                <input type="text" name="comment[body]" placeholder="コメントを入力する。">
            </div>
            <input type="submit" value="送信"/>
        </form>
        <div class="footer">
            <div class="back">[<a href="/">戻る</a>]</div>
        </div>
    </body>
</html>