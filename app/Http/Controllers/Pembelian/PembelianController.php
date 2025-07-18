<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PembelianController extends Controller
{
    public function index(): View {
        $products = Product::all();
        return view('pages.pembelian.index', ['title' => 'Purchase Page', 'products' => $products]);
    }
}
