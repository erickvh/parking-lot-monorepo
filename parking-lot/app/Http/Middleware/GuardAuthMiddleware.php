<?php

namespace App\Http\Middleware;

use App\services\AuthService;
use Closure;
use Illuminate\Http\Request;

class GuardAuthMiddleware
{
    private $serviceAuth = null;
    public function __construct()
    {
        $this->serviceAuth = new AuthService();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        list("message" => $message, "user" => $user) = $this->serviceAuth->getUserAuthByToken($request->bearerToken());

        if ($message != "success") return response()->json(["message" => "Unauthorized"], 401);

        $request->attributes->set('user', $user);
        return $next($request);
    }
}
