<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function like(Tweet $tweet)
    {
        // Prevent duplicate likes
        if (!$tweet->likes()->where('user_id', auth()->id())->exists()) {
            $tweet->likes()->create([
                'user_id' => auth()->id()
            ]);
        }

        return response()->json([
            'liked' => true,
            'likes_count' => $tweet->likes()->count()
        ]);
    }

    public function unlike(Tweet $tweet)
    {
        $tweet->likes()->where('user_id', auth()->id())->delete();

        return response()->json([
            'liked' => false,
            'likes_count' => $tweet->likes()->count()
        ]);
    }
}
