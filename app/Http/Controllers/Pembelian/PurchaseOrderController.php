<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Laporan\LaporanStok;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Product;
use App\Models\PurchaseOrderDetail;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PurchaseOrderController extends Controller
{
    public function index() {
        $dataProduct = Product::get();
        $dataSupplier = Supplier::get();
        $user = JWTAuth::parseToken()->authenticate();
        $dataPO = PurchaseOrder::with('supplier')->get();

        if($user->roles == 'Kasir') return redirect('penjualan');

        return view('pages.pembelian.index', ['title' => 'Purchase Order Page', 'dataProduct' => $dataProduct, 'dataSupplier' => $dataSupplier, 'dataPO' => $dataPO, 'user' => $user]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $purchase_order = PurchaseOrder::orderBy('id', 'desc')->select('id')->first();

            if($purchase_order) {
                $nomorPO = 'PO-' . sprintf('%04d', (int) $purchase_order->id + 1);
            } else {
                $nomorPO = 'PO-0001';
            }

            DB::transaction(function () use($request, $nomorPO) {
                $createPO = PurchaseOrder::create([
                    'nomor_purchase_order' => $nomorPO,
                    'supplier_id' => $request->supplier_id,
                    'tanggal_order' => now(),
                    'grandtotal' => $request->grandtotal,
                ]);

                if(!$createPO) {
                    throw new \Exception('Gagal membuat data penjualan');
                }

                foreach($request->products as $item) {
                    $qty = (int) $item['qty'];
                    $subtotal = (int) $item['subtotal'];
                    $product = Product::findOrFail($item['id']);

                    PurchaseOrderDetail::create([
                        'purchase_order_id' => $createPO->id,
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'subtotal' => $subtotal
                    ]);

                    LaporanStok::create([
                        'product_id' => $product->id,
                        'referensi' => $nomorPO,
                        'tipe_pergerakan' => 'Masuk',
                        'tanggal_transaksi' => now(),
                        'stok_awal' => $product->stock,
                        'qty' => $qty,
                        'stok_akhir' => $product->stock + $qty
                    ]);

                    $product->update([
                        'stock' => $product->stock + $qty
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

    public function getPODetail(int $id): JsonResponse {
        try {
            $dataPODetail = PurchaseOrderDetail::with('product')->where('purchase_order_id', $id)->get();

            if(!$dataPODetail) {
                return response()->json(['status' => 'error', 'message' => 'Data purchase order detail tidak ditemukan'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data purchase order detail ditemukan', 'data' => $dataPODetail], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}