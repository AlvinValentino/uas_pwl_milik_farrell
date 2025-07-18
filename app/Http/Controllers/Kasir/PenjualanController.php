<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Laporan\LaporanStok;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PenjualanController extends Controller
{
    public function index() {
        $products = Product::where('stock', '>', '0')->get();
        $user = JWTAuth::parseToken()->authenticate();

        if($user->roles == 'Pembelian') return redirect('purchase_order');
        
        return view('pages.kasir.index', ['title' => 'Sales Page', 'products' => $products, 'user' => $user]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $penjualan = Penjualan::orderBy('id', 'desc')->select('id')->first();

            if($penjualan) {
                $nomorPenjualan = 'FJ-' . sprintf('%04d', (int) $penjualan->id + 1);
            } else {
                $nomorPenjualan = 'FJ-0001';
            }

            DB::transaction(function () use($request, $nomorPenjualan) {
                $createPenjualan = Penjualan::create([
                    'user_id' => 1,
                    'nomor_penjualan' => $nomorPenjualan,
                    'tanggal_jual' => now(),
                    'grandtotal' => $request->grandtotal,
                ]);

                if(!$createPenjualan) {
                    throw new \Exception('Gagal membuat data penjualan');
                }

                foreach($request->products as $item) {
                    $qty = (int) $item['qty'];
                    $price = (int) $item['price'];
                    $product = Product::findOrFail($item['id']);

                    PenjualanDetail::create([
                        'penjualan_id' => $createPenjualan->id,
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'subtotal' => $price * $qty
                    ]);

                    LaporanStok::create([
                        'product_id' => $product->id,
                        'referensi' => $nomorPenjualan,
                        'tipe_pergerakan' => 'Keluar',
                        'tanggal_transaksi' => now(),
                        'stok_awal' => $product->stock,
                        'qty' => $qty,
                        'stok_akhir' => $product->stock - $qty
                    ]);

                    $product->update([
                        'stock' => $product->stock - $qty
                    ]);
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan.',
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}