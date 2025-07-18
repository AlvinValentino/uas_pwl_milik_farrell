<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class SupplierController extends Controller
{
    public function index() {
        $dataSupplier = Supplier::get();
        $user = JWTAuth::parseToken()->authenticate();

        if($user->roles == 'Pembelian') return redirect('purchase_order');
        else if($user->roles == 'Kasir') return redirect('penjualan');

        return view('pages.admin.supplier', ['title' => 'Supplier Management Page', 'dataSupplier' => $dataSupplier, 'user' => $user]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $supplier = Supplier::orderBy('id', 'desc')->select('id')->first();

            if($supplier) {
                $request['kode_supplier'] = 'SUP-' . sprintf('%04d', (int) $supplier->id + 1);
            } else {
                $request['kode_supplier'] = 'SUP-0001';
            }

            $validator = Validator::make($request->all(), [
                'kode_supplier' => 'required|string|unique:suppliers',
                'nama_supplier' => 'required|string|min:1',
                'no_telp_supplier' => 'required|string|min:1',
                'email_supplier' => 'required|string|min:1',
                'alamat_supplier' => 'required|string|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }
    
            $createSupplier = Supplier::create($validator->validated());
    
            if(!$createSupplier) {
                return response()->json(['status' => 'error', 'message' => 'Data supplier gagal dibuat!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data supplier berhasil dibuat!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        try {
            $dataSupplier = Supplier::findOrFail($id);
            
            if(!$dataSupplier) {
                return response()->json(['status' => 'error', 'message' => 'Data supplier tidak ditemukan!'], 422);
            }
        
            return response()->json(['status' => 'success', 'message' => 'Data supplier berhasil ditemukan!', 'data' => $dataSupplier], 200);
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
                'nama_supplier' => 'required|string|min:1',
                'no_telp_supplier' => 'required|string|min:1',
                'email_supplier' => 'required|string|min:1',
                'alamat_supplier' => 'required|string|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            $updateSupplier = Supplier::findOrFail($id)->update($validator->validated());
    
            if(!$updateSupplier) {
                return response()->json(['status' => 'error', 'message' => 'Data supplier gagal diubah!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data supplier berhasil diubah!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $deleteSupplier = Supplier::findOrFail($id)->delete();

            if(!$deleteSupplier) {
                return response()->json(['status' => 'error', 'message' => 'Data supplier gagal dihapus!'], 422);
            }

            return response()->json(['status' => 'success', 'message' => 'Data supplier berhasil dihapus!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
