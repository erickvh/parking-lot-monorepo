<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class AuthService
{

    public function getUserAuthByToken($token)
    {
        try {
            $response = Http::withHeaders(["Authorization" => "Bearer $token"])->get(getenv('MS_AUTH_URL') .
                '/user');
            if ($response->status() != 200) return ["message" => "Unauthorized", "user" => null];
            $user = $response->json();
            return ["message" => "success", "user" => $user];
        } catch (\Exception $e) {
            return ["message" => "Unauthorized", "user" => null];
        }
    }
}
