<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Tweet $tweet)
    {
        $user = auth()->user();

        // Check if already liked
        $alreadyLiked = $tweet->likes()->where('user_id', $user->id)->exists();

        if ($alreadyLiked) {
            // Unlike
            $tweet->likes()->where('user_id', $user->id)->delete();
        } else {
            // Like
            $tweet->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'likes' => $tweet->likes()->count()
        ]);
    }
}
