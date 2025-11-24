@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8">

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
        <p class="text-gray-600">
            Joined {{ $user->created_at->format('F Y') }}
        </p>

        <div class="mt-4 flex gap-6 text-gray-700">
            <span><strong>{{ $total_tweets }}</strong> Tweets</span>
            <span><strong>{{ $total_likes }}</strong> Likes Received</span>
        </div>
    </div>

    <h3 class="text-xl font-semibold mb-4">Tweets</h3>

    @foreach($tweets as $tweet)
        <div class="bg-white shadow rounded-lg p-5 mb-4">
            <p>{{ $tweet->content }}</p>
            <span class="text-sm text-gray-500">{{ $tweet->created_at->diffForHumans() }}</span>
        </div>
    @endforeach
</div>
@endsection
