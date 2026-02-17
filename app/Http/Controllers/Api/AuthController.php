<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'role' => User::$client,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_2' => $request->password,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    // Get profile
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }


    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'profile_pic' => 'sometimes|image|max:2048'
        ]);

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pics', 'public');
            $user->profile_pic = $path;
        }

        $user->update($request->only('name'));

        return response()->json($user);
    }
}
