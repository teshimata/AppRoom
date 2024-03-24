<x-app-layout>
    <h1>タイムライン</h1>
    <a href='/posts/create'>投稿一覧</a>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
            <div>
                <img src="{{ $post->image_url }}" alt="画像が投稿されていません。"/>
            </div>
                <p class='body'>{{ $post->body }}</p>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                </form>
            </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
    <script>
        function deletePost(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>