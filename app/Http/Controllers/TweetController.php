<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    // Show all tweets
    public function index()
    {
        $tweets = Tweet::with(['user', 'likes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tweets.index', compact('tweets'));
    }

    // Store a new tweet
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('tweets.index');
    }

    // Edit form
    public function edit(Tweet $tweet)
    {
        // Simple manual authorization
        if ($tweet->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('tweets.edit', compact('tweet'));
    }

    // Update tweet
    public function update(Request $request, Tweet $tweet)
    {
        if ($tweet->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $tweet->update([
            'content' => $request->content,
        ]);

        return redirect()->route('tweets.index')->with('success', 'Tweet updated.');
    }

    // Delete tweet
    public function destroy(Tweet $tweet)
    {
        if ($tweet->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $tweet->delete();

        return redirect()->route('tweets.index')->with('success', 'Tweet deleted.');
    }

    // ⭐ AJAX Like
    public function like(Tweet $tweet)
    {
        $tweet->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'liked' => true,
            'likes_count' => $tweet->likes()->count(),
        ]);
    }

    // ⭐ AJAX Unlike
    public function unlike(Tweet $tweet)
    {
        $tweet->likes()->where('user_id', auth()->id())->delete();

        return response()->json([
            'liked' => false,
            'likes_count' => $tweet->likes()->count(),
        ]);
    }
}
