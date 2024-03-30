<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h2 class="title text-2xl font-bold">
                {{ $post->title }}
            </h2>
        </div>
        <!-- 画像を複数表示 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($post->images as $image)
                <div class="rounded overflow-hidden shadow-lg">
                    <img src="{{ $image->image_url }}" alt="画像が投稿されていません。" class="w-full"/>
                </div>
            @endforeach
        </div>
        
        <!-- リンクを複数表示 -->
        <!-- リンクがある場合はここに表示するコードを追加 -->

        <div class="content mt-6">
            <div class="content__post mb-4">
                <p class="text-gray-700">{{ $post->body }}</p>    
            </div>
           <div class="content__post mb-4">
                <p class="text-gray-700">{{ $post->link_url }}</p>    
            </div>
            <a href="/categories/{{ $post->category->id }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $post->category->name }}</a>
            @if ($post->likes->contains('user_id', Auth::id()))
                <form action="{{ route('likes.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">いいね解除</button>
                </form>
            @else
                <form action="{{ route('likes.store', $post) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">いいね</button>
                </form>
            @endif
        </div>
        <div class="edit mt-4 mb-2"><a href="/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-800">投稿内容の編集</a></div>
        <div class="comment mb-4"><a href="/posts/{{ $post->id }}/comments/create" class="text-blue-500 hover:text-blue-800">コメントの投稿</a></div>
        
        <!-- コメントを複数表示 -->
        <h3 class="text-xl font-semibold mb-4">コメント</h3>
        @foreach ($comments as $comment)
            <div class="comments bg-white shadow overflow-hidden rounded-md mb-4">
                <div class="px-4 py-4 sm:px-6 bg-gray-100">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-indigo-600 truncate">{{ $comment->user->name }}</p>
                    </div>
                </div>
                <div class="px-4 py-4 sm:px-6">
                    <p class="text-sm text-gray-700">
                        {{ $comment->body }}
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <div class="-mt-px flex">
                        <div class="w-0 flex-1 flex justify-between">
                            <a href="/posts/{{ $post_id }}/comments/{{ $comment->id }}/edit" class="text-blue-500 hover:text-blue-800 ml-4 my-2">コメントの編集</a>
                            <form action="/posts/{{ $post_id }}/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" class="inline-flex">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteComment({{ $comment->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded mr-4 my-2">コメントの削除</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="footer text-center mt-8">
            <a href="/" class="text-blue-500 hover:text-blue-800">戻る</a>
        </div>
    </div>
    <script>
    function deleteComment(id) {
        'use strict'
        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
    </script>
</x-app-layout>
