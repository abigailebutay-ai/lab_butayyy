<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load(['tweets.likes']);

        return view('users.show', [
            'user' => $user,
            'tweets' => $user->tweets()->latest()->get(),
            'total_tweets' => $user->tweets()->count(),
            'total_likes' => $user->tweets()->withCount('likes')->get()->sum('likes_count'),
        ]);
    }
}
