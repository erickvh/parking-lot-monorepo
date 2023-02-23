<?php

namespace App\services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user;
    }


    public function login($request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) return [
            'message' => 'Invalid credentials',
            "token" => null,
        ];


        return [
            'message' => 'success',
            'token' => $user->createToken('token')->plainTextToken,
        ];
    }


    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'User logged out'
        ];
    }

    public function user($request)
    {
        return $request->user();
    }
}
