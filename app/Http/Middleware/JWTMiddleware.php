<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->bearerToken();

            if (!$token && $request->cookie('token')) {
                $token = $request->cookie('token');
            }

            // Coba untuk mengautentikasi pengguna dengan token
            if (!$user = JWTAuth::setToken($token)->authenticate()) {
                return redirect()->route('login')->withErrors(['User tidak ditemukan!']);
                // return response()->json(['error' => 'User  not found'], 404);
            }
        } catch (TokenExpiredException $e) {
            // return response()->json(['error' => 'Token has expired'], 401);
            return redirect()->route('login')->withErrors(['Anda tidak bisa mengakses halaman tersebut! Token Anda kadaluarsa, silahkan login terlebih dahulu!']);
        } catch (TokenInvalidException $e) {
            return redirect()->route('login')->withErrors(['Anda tidak bisa mengakses halaman tersebut! Token Anda invalid, silahkan login terlebih dahulu!']);
            // return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return redirect()->route('login')->withErrors(['Anda tidak bisa mengakses halaman tersebut! Token tidak disertakan, silahkan login terlebih dahulu!']);
            // return response()->json(['error' => 'Token not provided'], 401);
        }
        return $next($request);
    }
}