
<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\JwtService;
use Illuminate\Http\Request;

class AuthMiddleware
{
    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $jwt = $this->jwtService->parseToken($token);

        if (!$this->jwtService->validateToken($jwt)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = $this->jwtService->getUserFromToken($jwt);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $request->merge(['user' => $user]);

        return $next($request);
    }
}
