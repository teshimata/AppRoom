<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center my-4">
            <a href="/posts/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-lg px-6 py-3 rounded-lg">新規投稿</a>
        </di>
        <h1 class="text-2xl font-bold text-center my-8">カテゴリー：{{ $posts[0]->category->name }}</h1>
        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-center'>
            @foreach ($posts as $post)
                <div class='post max-w-sm rounded overflow-hidden shadow-lg'>
                   <div class="overflow-hidden">
                        <!-- 画像を複数表示 -->
                        <div class="swiper-container" style="height: 200px;"> <!-- Swiper.jsを使う場合 -->
                            @foreach($post->images as $image)
                                <div class="rounded overflow-hidden shadow-lg">
                                    <img src="{{ $image->image_url }}" alt="画像が投稿されていません。" class="w-full h-full object-cover"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class='px-6 py-4'>
                        <div class='font-bold text-xl mb-2'>
                            <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:text-blue-800">{{ $post->title }}</a>
                        </div>
                        <p class='text-gray-700 text-base'>
                            {{ $post->body }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <a href="/categories/{{ $post->category->id }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $post->category->name }}</a>
                    </div>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="px-6 pt-4 pb-2">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">削除</button> 
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate text-center my-8'>
            {{ $posts->links() }}
        </div>
    </div>
    <script>
        function deletePost(id) {
            'use strict';
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
