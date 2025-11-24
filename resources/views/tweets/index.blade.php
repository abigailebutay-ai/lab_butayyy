@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-[#f5f7fa] to-[#e3e7ee] py-10">

    <div class="max-w-2xl mx-auto space-y-8">

        {{-- Tweet Composer --}}
        <div class="bg-white/90 backdrop-blur shadow-lg rounded-2xl p-6 border border-gray-200">
            <form action="{{ route('tweets.store') }}" method="POST">
                @csrf

                <textarea name="content" rows="3" maxlength="280"
                    class="w-full p-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none resize-none text-gray-800 placeholder-gray-400"
                    placeholder="What's happening?">{{ old('content') }}</textarea>

                <div class="flex items-center justify-between mt-2">
                    <span class="text-sm text-gray-500" id="char-count">0 / 280</span>

                    <button
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow transition">
                        Tweet
                    </button>
                </div>
            </form>
        </div>

        {{-- Tweets List --}}
        @foreach($tweets as $tweet)
        <div class="bg-white/90 backdrop-blur shadow-lg rounded-2xl p-6 border border-gray-200 hover:shadow-xl transition">
            <div class="flex justify-between items-start">

                <div class="space-y-2 w-full">
                    {{-- User --}}
                    <a href="{{ route('users.show', $tweet->user->id) }}"
                       class="font-semibold text-blue-700 hover:underline text-lg">
                        {{ $tweet->user->name }}
                    </a>

                    {{-- Tweet Text --}}
                    <p class="text-gray-800 leading-relaxed text-[15px]">
                        {{ $tweet->content }}
                    </p>

                    {{-- Time + Likes --}}
                    <div class="flex items-center gap-5 text-sm text-gray-500 pt-1">
                        <span>{{ $tweet->created_at->diffForHumans() }}</span>
                        <span id="likes-count-{{ $tweet->id }}">{{ $tweet->likes->count() }} likes</span>
                    </div>
                </div>

                {{-- Right side buttons --}}
                <div class="flex flex-col items-end gap-2">

                    {{-- Like Button --}}
                    @if($tweet->likedByUser(auth()->user()))
                        <button class="px-3 py-1 text-sm font-medium border rounded-xl text-red-500 border-red-300 like-btn"
                            data-tweet="{{ $tweet->id }}" data-action="unlike">
                            ❤️ Unlike
                        </button>
                    @else
                        <button class="px-3 py-1 text-sm font-medium border rounded-xl text-blue-500 border-blue-300 like-btn"
                            data-tweet="{{ $tweet->id }}" data-action="like">
                            👍 Like
                        </button>
                    @endif

                    {{-- Owner Controls --}}
                    @if($tweet->user_id === auth()->id())
                    <div class="flex gap-3 mt-1">
                        <a href="{{ route('tweets.edit', $tweet) }}" class="text-yellow-600 hover:text-yellow-700 font-medium">
                            Edit
                        </a>

                        <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('Delete tweet?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <div>
            {{ $tweets->links() }}
        </div>

    </div>
</div>

{{-- Character Counter + AJAX --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // CHAR COUNTER
    const textarea = document.querySelector('textarea[name="content"]');
    const counter = document.getElementById('char-count');

    textarea.addEventListener('input', () => {
        counter.textContent = `${textarea.value.length} / 280`;
    });

    // LIKE / UNLIKE AJAX
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', async () => {

            const tweetId = btn.dataset.tweet;
            const action = btn.dataset.action;

            const res = await fetch(`/tweets/${tweetId}/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            const data = await res.json();

            document.getElementById(`likes-count-${tweetId}`).textContent =
                `${data.likes_count} likes`;

            if (data.liked) {
                btn.textContent = '❤️ Unlike';
                btn.classList.replace('text-blue-500', 'text-red-500');
                btn.classList.replace('border-blue-300', 'border-red-300');
                btn.dataset.action = 'unlike';
            } else {
                btn.textContent = '👍 Like';
                btn.classList.replace('text-red-500', 'text-blue-500');
                btn.classList.replace('border-red-300', 'border-blue-300');
                btn.dataset.action = 'like';
            }
        });
    });
});
</script>

@endsection
