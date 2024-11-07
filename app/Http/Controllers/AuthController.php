<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }

    // Login User
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if ($token = JWTAuth::attempt($credentials)) {
        $user = JWTAuth::user();

        // Use forceFill to ensure remember_token is saved
        $user->forceFill(['remember_token' => $token])->save();

        return response()->json(['token' => $token]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}


    // Logout User
    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->token);

        return response()->json(['message' => 'Successfully logged out']);
    }
}
