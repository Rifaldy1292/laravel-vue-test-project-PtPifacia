<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada token di header Authorization
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['error' => 'Token missing'], 401);
        }

        try {
             
            // Verifikasi token
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Token is invalid or expired'], 401);
            }

            // Lanjutkan ke request berikutnya
            return $next($request);
        } catch (JWTException $e) {
            // Tangani kesalahan token yang tidak valid
            return response()->json(['error' => 'Token is invalid'], 401);
        }
    }
}
