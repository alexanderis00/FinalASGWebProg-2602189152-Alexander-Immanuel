<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $theme = 'Casual';

        return view('home', compact('users', 'theme'));
    }

    public function filter(Request $request)
    {
        $gender = $request->input('gender');
        
        $users = User::when($gender, function ($query, $gender) {
            return $query->where('gender', $gender);
        })->get();

        return view('home', [
            'users' => $users,
            'theme' => 'Casual', 
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('hobbies', 'LIKE', "%{$query}%")->get();

        return view('home', [
            'users' => $users,
            'theme' => 'Casual', 
        ]);
    }

}

