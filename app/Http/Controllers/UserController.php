<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index() {
        $dataUser = User::get();
        $user = JWTAuth::parseToken()->authenticate();

        if($user->roles == 'Pembelian') return redirect('purchase_order');
        else if($user->roles == 'Kasir') return redirect('penjualan');
        
        return view('pages.admin.user', ['title' => 'User Management Page', 'dataUser' => $dataUser, 'user' => $user]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|unique:users',
                'name' => 'required|string|min:1',
                'roles' => 'required|string|min:1',
                'password' => 'required|string|min:1',
            ]);
    
            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            $createUser = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'roles' => $request->roles
            ]);
    
            if(!$createUser) {
                return response()->json(['status' => 'error', 'message' => 'Data user gagal dibuat!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data user berhasil dibuat!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        try {
            $dataUser = User::findOrFail($id);
            
            if(!$dataUser) {
                return response()->json(['status' => 'error', 'message' => 'Data user tidak ditemukan!'], 422);
            }
        
            return response()->json(['status' => 'success', 'message' => 'Data user berhasil ditemukan!', 'data' => $dataUser], 200);
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
                'username' => 'required|string',
                'name' => 'required|string|min:1',
                'roles' => 'required|string|min:1',
                'password' => ''
            ]);

            if($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validasi gagal'], 400);
            }

            if($request->password != null) {
                $updateUser = User::findOrFail($id)->update($validator->validated());
            } else {
                $updateUser = User::findOrFail($id)->update([
                    'username' => $request->username,
                    'name' => $request->name,
                    'roles' => $request->roles
                ]);
            }
    
            if(!$updateUser) {
                return response()->json(['status' => 'error', 'message' => 'Data user gagal diubah!'], 422);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data user berhasil diubah!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $deleteUser = User::findOrFail($id)->delete();

            if(!$deleteUser) {
                return response()->json(['status' => 'error', 'message' => 'Data user gagal dihapus!'], 422);
            }

            return response()->json(['status' => 'success', 'message' => 'Data user berhasil dihapus!'], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
