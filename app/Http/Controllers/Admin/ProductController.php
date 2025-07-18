<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function index() {
        $dataProduct = Product::with('product_category')->get();
        $dataCategory = ProductCategory::get();
        $user = JWTAuth::parseToken()->authenticate();

        if($user->roles == 'Pembelian') return redirect('purchase_order');
        else if($user->roles == 'Kasir') return redirect('penjualan');

        return view('pages.admin.product', ['title' => 'Product Management Page', 'dataProduct' => $dataProduct, 'dataCategory' => $dataCategory, 'user' => $user]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'kode_product' => 'required|string|unique:products',
                'nama_product' => 'required|string|min:1',
                'foto_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'product_category_id' => 'required|integer|min:1',
                'harga_beli' => 'required|integer|min:1',
                'harga_jual' => 'required|integer|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            if ($request->hasFile('foto_product')) {
                $path = $request->file('foto_product')->store('products', 'public');
            }
    
            $createProduct = Product::create([
                'kode_product' => $request->kode_product,
                'nama_product' => $request->nama_product,
                'foto_product' => $path ?? null,
                'product_category_id' => $request->product_category_id,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]);
    
            if(!$createProduct) {
                return response()->json(['status' => 'error', 'message' => 'Data produk gagal dibuat!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data produk berhasil dibuat!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        try {
            $dataProduct = Product::with('product_category')->findOrFail($id);
            
            if(!$dataProduct) {
                return response()->json(['status' => 'error', 'message' => 'Data produk tidak ditemukan!'], 422);
            }
        
            return response()->json(['status' => 'success', 'message' => 'Data produk berhasil ditemukan!', 'data' => $dataProduct], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, int $id): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'nama_product' => 'required|string|min:1',
                'product_category_id' => 'required|integer|min:1',
                'harga_beli' => 'required|integer|min:1',
                'harga_jual' => 'required|integer|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            $updateProduct = Product::findOrFail($id)->update($validator->validated());
    
            if(!$updateProduct) {
                return response()->json(['status' => 'error', 'message' => 'Data produk gagal diubah!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data produk berhasil diubah!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $deleteProduct = Product::findOrFail($id)->delete();

            if(!$deleteProduct) {
                return response()->json(['status' => 'error', 'message' => 'Data produk gagal dihapus!'], 422);
            }

            return response()->json(['status' => 'success', 'message' => 'Data produk berhasil dihapus!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
