<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index() {
        return view('pages.kasir.index', ['title' => 'Sales Page']);
    }
}