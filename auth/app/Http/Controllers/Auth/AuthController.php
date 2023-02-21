<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Bad credentials'
            ], 401);
        }
        $body = [
            'message' => 'success',
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken,
        ];
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {


        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'User logged out'
        ]);
    }
}
