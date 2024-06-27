<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JWTToken;

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

        try {
            $jwt = $this->jwtService->parseToken($token);

            if (!$this->jwtService->validateToken($jwt)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $user = $this->jwtService->getUserFromToken($jwt);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Update last_used_at for the token
            $tokenId = $jwt->claims()->get('jti');
            $jwtToken = JWTToken::where('unique_id', $tokenId)->first();
            if ($jwtToken) {
                $jwtToken->update(['last_used_at' => now()]);
            }

            // Set the authenticated user for the current request
            Auth::setUser($user);
            $request->merge(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 403);
        }

        return $next($request);
    }
}
