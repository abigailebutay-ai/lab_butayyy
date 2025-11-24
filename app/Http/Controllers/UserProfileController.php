<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $tweets = $user->tweets()->with('likes')->latest()->get();
        $tweetCount = $tweets->count();
        $totalLikes = $tweets->sum(fn($t) => $t->likes->count());

        return view('users.show', compact('user', 'tweets', 'tweetCount', 'totalLikes'));
    }
}
