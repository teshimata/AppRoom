<x-app-layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="title text-3xl font-bold text-center mb-8">コメントの編集</h1>
        <div class="content">
            <form action="/posts/{{ $post_id }}/comments/{{ $comment->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class='content__body space-y-2'>
                    <h2 class="text-xl font-semibold">本文</h2>
                    <input type='text' name='comment[body]' value="{{ $comment->body }}" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
                <input type="submit" value="更新" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            </form>
        </div>
    </div>
</x-app-layout>
