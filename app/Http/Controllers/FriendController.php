<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FriendController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:users,id',
        ]);

        $authUser = Auth::user();
        $friendId = $request->input('friend_id');

        if ($authUser->friends->contains($friendId)) {
            return response()->json(['message' => 'Friend already added'], 400);
        }

        $authUser->addFriend(User::findOrFail($friendId));

        return response()->json(['message' => 'Friend added'], 201);
    }

    public function index()
    {
        $authUser = Auth::user();
        $friends = $authUser->friends;

        return view('profile', compact('friends'));
    }

    public function destroy($id)
    {
        $authUser = Auth::user();
        $friend = User::findOrFail($id);

        if (!$authUser->friends->contains($id)) {
            return response()->json(['message' => 'Friend not found'], 404);
        }

        $authUser->removeFriend($friend);

        return response()->json(['message' => 'Friendship removed'], 200);
    }

}
