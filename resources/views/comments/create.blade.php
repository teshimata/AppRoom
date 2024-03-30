<x-app-layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-center mb-6">コメント</h2>
        <form action="/posts/{{ $post_id }}/comments" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="body">
                <input type="text" name="comment[body]" placeholder="コメントを入力する。" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
            </div>
            <input type="submit" value="送信" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer"/>
        </form>
        <div class="footer mt-6 text-center">
            <div class="back">[<a href="/" class="text-blue-500 hover:text-blue-800">戻る</a>]</div>
        </div>
    </div>
</x-app-layout>
