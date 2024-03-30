<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">新規投稿</h1>
         <form action="/posts" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">タイトル</h2>
                <input type="text" name="post[title]" value="{{ old('post.title') }}" placeholder="タイトル" class="w-full p-2 border border-gray-300 rounded"/>
                <p class="title__error text-red-500">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">画像</h2>
                <!-- 画像フィールドはoldヘルパーを使わない -->
                <input name="images[]" type="file" onchange="elementClone()" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer"/>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">リンク</h2>
                <input type="url" name="post[link_url]" value="{{ old('post.link_url') }}" placeholder="リンクを入力" class="w-full p-2 border border-gray-300 rounded"/>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">本文</h2>
                <textarea name="post[body]" placeholder="キャプションを入力する。" class="w-full p-2 border border-gray-300 rounded">{{ old('post.body') }}</textarea>
                <p class="body__error text-red-500">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">Category</h2>
                <select name="post[category_id]" class="w-full p-2 border border-gray-300 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('post.category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="投稿する" class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded"/>
        </form>
        <div class="back mt-4">[<a href="/" class="text-blue-500 hover:text-blue-800">戻る</a>]</div>
    </div>
    <script>
        function elementClone() {
            // 現在のスクリプトはjQueryを参照していますが、Tailwindのサンプルには影響しません
            let cloneObj = $($('input[name="images[]"]')[0]).clone();
            cloneObj.attr('name', `images[]`);
            cloneObj.appendTo('.images'); // 正しいコンテナに追加するために修正
        }
    </script>
</x-app-layout>
