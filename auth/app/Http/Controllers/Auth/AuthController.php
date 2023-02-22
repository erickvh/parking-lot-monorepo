<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(LoginRequest $request)
    {

        $body = $this->authService->login($request);

        return response()->json($body);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request);

        return response()->json([
            'message' => 'success',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {


        $body = $this->authService->logout($request);

        return response()->json($body);
    }
}
