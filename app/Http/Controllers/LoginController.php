<?php   

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phoneNumber', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }
        
        return Redirect::back()->withErrors(['phoneNumber' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
