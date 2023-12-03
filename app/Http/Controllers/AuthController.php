<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = array(
            'user_name' => $request->input('username'),
            'password' => $request->input('password')
        );

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login successfully');
        }

        return redirect()->back()->with('failed', 'Invalid Username or Password');
    }

    public function doLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
