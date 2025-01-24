<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }

        return view('auth.login');
    }
    
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $validateAuth = Auth::attempt($credentials);

        if ($validateAuth) {
            setUserSession($request->email);
            $request->session()->regenerate();

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        };

        return back()->withErrors(['messages' => 'Email atau Password Anda salah']);
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $uuid = generateUuid();
        $data = $request->all();

        User::create([
            'uuid' => $uuid,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect("/")->withSuccess('Great! You have Successfully Registered');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login')->with('message', 'log out succeed');
    }
}
