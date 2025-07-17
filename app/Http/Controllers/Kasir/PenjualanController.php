<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PenjualanController extends Controller
{
    public function index(): View {
        $products = Product::all();
        return view('pages.kasir.index', ['title' => 'Sales Page', 'products' => $products]);
    }

    public function store(Request $request) {
        try {
            $penjualan = Penjualan::orderBy('id', 'desc')->select('id')->first();

            if($penjualan) {
                $request['nomor_penjualan'] = 'FJ-' . sprintf('%04d', (int) $penjualan->id + 1);
            } else {
                $request['nomor_penjualan'] = 'FJ-0001';
            }

            \DB::transaction(function () {
                $createPenjualan = Penjualan::create([
                    'user_id' => 1,
                    'nomor_penjualan' => $request->nomor_penjualan,
                    'tanggal_jual' => now(),
                    'grandtotal' => $request->grandtotal,
                ]);

                if(!$createPenjualan) {
                    throw new \Exception('Gagal membuat data penjualan');
                }

                foreach($products as $product) {
                    $createPenjualanDetail = PenjualanDetail::create([
                        'penjualan_id' => $createPenjualan->id,
                        'product_id' => $product['id'],
                        'qty' => $product['qty'],
                        'subtotal' => $product['price'] * $product['qty']
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