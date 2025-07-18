<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    public function index(): View {
        $user = JWTAuth::parseToken()->authenticate();

        return view('pages.dashboard', ['title' => 'Dashboard Page', 'user' => $user]);
    }

}
