<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Comment</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h2>コメント一覧</h2>
        <div class='comments'>
            @foreach ($comments as $comment)
                <div class='comment'>
                    <p class='body'>{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    </body>
</html>