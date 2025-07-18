<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use Illmuninate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    public function index(): View {
        return view('pages.dashboard', ['title' => 'Dashboard Page']);
    }

}
