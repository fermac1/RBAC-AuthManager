<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // $token = Cookie::get('jwt');

            $token = $request->cookie('jwt');
            Log::info('JWT Token from cookie:', ['token' => $token]);

            if (!$token) {
                Log::info('error: Token not provided');
                // return response()->json(['error' => 'Token not provided'], 401);
                return redirect('/');
            }
            // $user = JWTAuth::parseToken()->authenticate();
            // JWTAuth::parseToken()->authenticate();
            JWTAuth::setToken($token)->authenticate();

        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}
