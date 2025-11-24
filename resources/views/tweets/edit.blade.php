@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-4">Edit Tweet</h2>

    <form action="{{ route('tweets.update', $tweet->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <textarea 
            name="content" 
            rows="4" 
            class="w-full border rounded p-2"
        >{{ old('content', $tweet->content) }}</textarea>

        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="mt-4 flex justify-end">
            <button 
                type="submit" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Update Tweet
            </button>
        </div>
    </form>

</div>
@endsection
