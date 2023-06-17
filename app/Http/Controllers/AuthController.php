<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function formSignUp() {
        return view('auth.sign-up');
    }

    public function register(Request $r) {
            $validated = $r->validate([
                'username' => 'required',
                'email' => 'required|email|unique:user',
                'password' => 'required|min:6',
                'first_name' => 'required',
            ]);

            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'first_name' => $validated['first_name'],
            ]);

            Auth::login($user);

            return redirect('/dashboard');
    }

    public function formLogin() {
        return view('auth.login');
    }

    public function login(Request $r) {
        try {
            $validated = $r->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt to authenticate the user
            if (Auth::attempt($validated)) {
                // Authentication successful
                return redirect('/dashboard');
            }

            // Authentication failed
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => 'Login failed. Please try again later.',
            ]);
        }
    }
}
