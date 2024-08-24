<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;

class CallController extends Controller
{
    public function initiate(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|in:voice,video',
        ]);

        $call = Call    ::create([
            'caller_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'type' => $request->type,
            'status' => 'initiated',
        ]);

        // Notify the receiver about the call (you might use a notification or event here)
        
        return response()->json($call);
    }

    public function update(Request $request, $id)
    {
        $call = Call::findOrFail($id);
        $call->update($request->only('status'));

        // Notify the caller about the status update

        return response()->json($call);
    }
}
