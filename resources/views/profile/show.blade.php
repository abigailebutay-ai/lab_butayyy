@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">

    {{-- User Header --}}
    <div class="border p-4 rounded mb-6 bg-white shadow">
        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
        <p class="text-gray-600">Joined {{ $user->created_at->format('F d, Y') }}</p>

        <div class="flex space-x-6 mt-4">
            <p><strong>{{ $tweetCount }}</strong> Tweets</p>
            <p><strong>{{ $totalLikes }}</strong> Likes Received</p>
        </div>
    </div>

    {{-- User Tweets --}}
    <h2 class="text-xl font-semibold mb-4">Tweets by {{ $user->name }}</h2>

    <div class="space-y-4">
        @foreach($tweets as $tweet)
            <div class="border p-4 rounded bg-white shadow">
                <p>{{ $tweet->content }}</p>
                <p class="text-sm text-gray-500">
                    {{ $tweet->created_at->diffForHumans() }}
                </p>

                {{-- Likes --}}
                <p class="text-sm text-gray-700">
                    ❤️ {{ $tweet->likes->count() }} likes
                </p>
            </div>
        @endforeach
    </div>

</div>
@endsection
