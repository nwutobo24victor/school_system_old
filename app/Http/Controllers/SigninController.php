<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    //
    public function create()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'remember' => 'string|max:255',
        ]);


        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) 
        {
            // Redirect to the intended route or dashboard
            /*return redirect()->intended('dashboard')->with('success', 'You are logged in.');*/
            return response()->json([
                'message' => 'You are logged in.',
                'error' => false
            ]);
        }

        // If login fails, redirect back with an error
        /*return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput($request->only('email'));*/
        return response()->json([
            'message' => 'Invalid credentials.',
            'error' => true
        ]);
        
    }

    public function signout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You are logged out.');
    }
}
