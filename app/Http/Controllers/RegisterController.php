<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showForm()
    {
        return view('register'); // Make sure the view is located at resources/views/register.blade.php
    }

    /**
     * Handle the registration form submission.
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'gender' => 'required|string|in:male,female,non-binary,prefer not to say',
            'hobby' => 'required|array|min:3',
            'email' => 'nullable|email|unique:users',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->gender = $request->input('gender');
        $user->hobby = implode(',', $request->input('hobby')); 
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('payment'); 
    }

}
