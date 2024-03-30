<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-center mb-6">コメント一覧</h2>
        <div class='comments space-y-4'>
            @foreach ($comments as $comment)
                <div class='comment bg-white shadow-md rounded-lg p-4'>
                    <p class='body text-gray-800'>{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
