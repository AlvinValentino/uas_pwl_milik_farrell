<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    public function index(Request $request) {
        if(!$request->user) {
            return redirect('/login');
        }
        return view('pages.pembelian.index', ['title' => 'Purchase Order Page']);
    }

}