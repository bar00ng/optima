<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {
        $pageName = 'Profile';
        $pageCategory = 'Profile';
        $user = Auth::user();

        return view('profile.profile', compact('pageName', 'pageCategory', 'user'));
    }

    public function patch(Request $r, $user_id) {
        try {
            $validated = $r->validate([
                'username' => 'required',
                'email' => 'required|email',
                'first_name' => 'required',
                'last_name' => 'filled',
                'address' => 'filled',
                'city' => 'filled',
                'country' => 'filled',
                'postal_code' => 'filled',
                'about_me' => 'filled'
            ]);

            User::where('id', $user_id)
                ->update($validated);

            return redirect('/profile')->with('Sukses', 'Profile berhasil diubah!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
