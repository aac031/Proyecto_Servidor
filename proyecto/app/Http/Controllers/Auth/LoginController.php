<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('administrators')->attempt($credentials)) {
            $user = Auth::guard('administrators')->user();
            if ($user->rol === 'recepcionista') {
                $request->session()->put('rol', 'recepcionista');
            } else if ($user->rol === 'gerente') {
                $request->session()->put('rol', 'gerente');
            }
            $request->session()->regenerate();
            return redirect()->intended('/socios');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
