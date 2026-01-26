<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('admin.auth.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Allow only Admin and Agent
            if (in_array($user->role, [User::$admin, User::$agent])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // Logout if not allowed role
            Auth::logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access admin panel.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
