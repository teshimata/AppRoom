<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="title text-3xl font-bold text-center mb-8">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class='content__title space-y-2'>
                    <h2 class="text-xl font-semibold">タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}" class="w-full p-2 border border-gray-300 rounded">
                </div>
                
               <!-- 画像を複数表示 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    @foreach($post->images as $image)
                        <div class="rounded overflow-hidden shadow-lg">
                            <img src="{{ $image->image_url }}" alt="画像が投稿されていません。" class="w-full"/>
                        </div>
                    @endforeach
                </div>
                
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold">画像</h2>
                    <input name="images[]" type="file" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer file:p-2 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                </div>
                
                <div class="link1 space-y-2">
                    <h2 class="text-xl font-semibold">リンク</h2>
                    <input type="text" name="post[link_url]" value="{{ $post->link_url }}" placeholder="リンクを貼り付ける" class="w-full p-2 border border-gray-300 rounded">
                </div>
                
                <div class='content__body space-y-2'>
                    <h2 class="text-xl font-semibold">本文</h2>
                    <textarea name='post[body]' class="w-full p-2 border border-gray-300 rounded" rows="4">{{ $post->body }}</textarea>
                </div>
                
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold">Category</h2>
                    <select name="post[category_id]" class="w-full p-2 border border-gray-300 rounded">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="更新" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </form>
            <div class="edit mt-4">
                <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:text-blue-800">戻る</a>
            </div>
        </div>
    </div>
    <script>
        function elementClone() {
            let imagesInput = document.querySelector('input[name="images[]"]');
            let cloneObj = imagesInput.cloneNode(); // Deep clone not required for input elements
            cloneObj.value = ''; // Reset file input value
            imagesInput.parentNode.insertBefore(cloneObj, imagesInput.nextSibling);
        }
    </script>
</x-app-layout>
