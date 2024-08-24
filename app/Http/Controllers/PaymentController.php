<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ]);

        Payment::create($request->only('user_id', 'amount'));

        return response()->json(['message' => 'Payment recorded'], 201);
    }

    public function index()
    {
        $payments = Payment::with('user')->get();
        return response()->json($payments);
    }
}
