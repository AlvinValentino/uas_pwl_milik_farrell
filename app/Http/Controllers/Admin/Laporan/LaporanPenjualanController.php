<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class LaporanPenjualanController extends Controller
{
    public function index(): View {
        $dataPenjualan = Penjualan::with('user')->get();
        return view('pages.admin.laporan.penjualan', ['title' => 'Laporan Penjualan Page', 'dataPenjualan' => $dataPenjualan]);
    }

    public function getPenjualanDetail(int $id): JsonResponse {
        try {
            $dataLaporanPenjualan = PenjualanDetail::with('product')->where('penjualan_id', $id)->get();

            if(!$dataLaporanPenjualan) {
                return response()->json(['status' => 'error', 'message' => 'Data laporan penjualan tidak ditemukan'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data laporan penjualan ditemukan', 'data' => $dataLaporanPenjualan], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
