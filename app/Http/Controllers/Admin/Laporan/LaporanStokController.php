<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Laporan\LaporanStok;
use App\Models\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class LaporanStokController extends Controller
{
    public function index(): View {
        $dataProduct = Product::get();
        return view('pages.admin.laporan.stok', ['title' => 'Laporan Stok Page', 'dataProduct' => $dataProduct]);
    }

    public function getLaporan(int $id): JsonResponse {
        try {
            $dataLaporanStok = LaporanStok::where('product_id', $id)->get();
    
            if(!$dataLaporanStok) {
                return response()->json(['status' => 'error', 'message' => 'Data laporan stok tidak ditemukan'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data laporan stok ditemukan', 'data' => $dataLaporanStok], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
