<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductCategoryController extends Controller
{
    public function index(): View {
        $dataCategory = ProductCategory::get();
        return view('pages.admin.product_category', ['title' => 'Product Category Management Page', 'dataCategory' => $dataCategory]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required|string|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }
    
            $createProductCategory = ProductCategory::create($validator->validated());
    
            if(!$createProductCategory) {
                return response()->json(['status' => 'error', 'message' => 'Data kategori produk gagal dibuat!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data kategori produk berhasil dibuat!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        try {
            $dataProductCategory = ProductCategory::findOrFail($id);
            
            if(!$dataProductCategory) {
                return response()->json(['status' => 'error', 'message' => 'Data kategori produk tidak ditemukan!'], 422);
            }
        
            return response()->json(['status' => 'success', 'message' => 'Data kategori produk berhasil ditemukan!', 'data' => $dataProductCategory], 200);
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
                'nama_kategori' => 'required|string|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            $updateProductCategory = ProductCategory::findOrFail($id)->update($validator->validated());
    
            if(!$updateProductCategory) {
                return response()->json(['status' => 'error', 'message' => 'Data kategori produk gagal diubah!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data kategori produk berhasil diubah!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $deleteProductCategory = ProductCategory::findOrFail($id)->delete();

            if(!$deleteProductCategory) {
                return response()->json(['status' => 'error', 'message' => 'Data kategori produk gagal dihapus!'], 422);
            }

            return response()->json(['status' => 'success', 'message' => 'Data kategori produk berhasil dihapus!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
