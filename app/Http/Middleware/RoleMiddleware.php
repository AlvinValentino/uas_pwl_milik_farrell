<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int ...$roles): Response
    {
        $token = $request->bearerToken() ?? $request->cookie('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['Anda tidak bisa mengakses halaman tersebut! Token tidak disertakan, silahkan login terlebih dahulu!']);
            // return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['Anda tidak bisa mengakses halaman tersebut! Token Anda kadaluarsa, silahkan login terlebih dahulu!']);

            // return response()->json(['error' => 'Invalid or expired token'], 401);
        }

        if (!in_array($user->role, $roles)) {
            return redirect()->route('dashboard')->with('error2', 'Anda tidak memiliki akses untuk mengakses halaman tersebut!');
            // return redirect()->route('dashboard')->withErrors(['Anda tidak memiliki akses untuk mengakses halaman tersebut!']);

            // return response()->json(['error' => 'Forbidden - wrong role'], 403);
        }

        return $next($request);
    }
}
