<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;

class LaporanPenjualanController extends Controller
{
    public function index() {
        $dataPenjualan = Penjualan::with('user')->get();
        $user = JWTAuth::parseToken()->authenticate();

        if($user->roles == 'Pembelian') return redirect('purchase_order');
        else if($user->roles == 'Kasir') return redirect('penjualan');

        return view('pages.admin.laporan.penjualan', ['title' => 'Laporan Penjualan Page', 'dataPenjualan' => $dataPenjualan, 'user' => $user]);
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
