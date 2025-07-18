<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function showLoginForm(Request $request) {
        $token = $request->cookie('token');
        if($token && JWTAuth::setToken($token)->check()) {
            return redirect('/dashboard');
        }

        return view('auth.login', ['title' => 'Login Page']);
    }

    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }
    
            $user = User::where('username', $request->username)->first();
    
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
            }
    
            try {
                $token = JWTAuth::fromUser($user);
                $request->attributes->set('user', $user);
            } catch (JWTException $e) {
                return response()->json(['status' => 'error', 'message' => 'Could not create token'], 500);
            }
    
            $cookie = cookie('token', $token, 1440, null, null, false, true);
    
            return response()->json(['status' => 'success', 'message' => 'Login berhasil!'], 200)->withCookie($cookie);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        
        if ($token) {
            try {
                JWTAuth::invalidate($token);
                $cookie = Cookie::forget('token');
                return response()->json(['status' => 'success', 'message' => 'Logout berhasil!'], 200)->withCookie($cookie);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Invalid token'], 401);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Token not provided'], 400);
    }
}
