<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'wishlisted_user_id' => 'required|exists:users,id',
        ]);

        Wishlist::create($request->only('user_id', 'wishlisted_user_id'));

        return response()->json(['message' => 'User added to wishlist'], 201);
    }

    public function index()
    {
        $wishlists = Wishlist::with('wishlistedUser')->get();
        return response()->json($wishlists);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return response()->json(['message' => 'Wishlist entry deleted'], 200);
    }
}
