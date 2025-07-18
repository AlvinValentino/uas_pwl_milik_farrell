<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function index(): View {
        $dataProduct = Product::with('product_category')->get();
        $dataCategory = ProductCategory::get();

        return view('pages.admin.product', ['title' => 'Product Management Page', 'dataProduct' => $dataProduct, 'dataCategory' => $dataCategory]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $product = Product::orderBy('id', 'desc')->select('id')->first();

            if($product) {
                $request['kode_product'] = 'SKU-' . sprintf('%04d', (int) $product->id + 1);
            } else {
                $request['kode_product'] = 'SKU-0001';
            }

            $validator = Validator::make($request->all(), [
                'kode_product' => 'required|string|unique:products',
                'nama_product' => 'required|string|min:1',
                'product_category_id' => 'required|integer|min:1',
                'harga_beli' => 'required|integer|min:1',
                'harga_jual' => 'required|integer|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }
    
            $createProduct = Product::create($validator->validated());
    
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
