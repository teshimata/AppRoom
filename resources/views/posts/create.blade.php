<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Room</title>
    </head>
    <body>
        <h1>新規投稿</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
            <div class="link1">
                <input type="text" name="post[link1]" placeholder="リンクを貼り付ける">
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="キャプションを入力する。"></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="category">
                <h2>Category</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <input type="submit" value="投稿する"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>