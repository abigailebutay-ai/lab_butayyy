@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-3">Create a Tweet</h2>

        <form action="{{ route('tweets.store') }}" method="POST">
            @csrf
            <textarea name="content" rows="4" maxlength="280" class="w-full border rounded p-2" placeholder="Your tweet...">{{ old('content') }}</textarea>
            <div class="mt-3 flex justify-between items-center">
                <span class="text-sm text-gray-500">Max 280 characters</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
