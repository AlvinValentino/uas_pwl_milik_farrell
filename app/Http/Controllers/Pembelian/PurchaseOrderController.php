<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Product;
use App\Models\Supplier;

class PurchaseOrderController extends Controller
{
    public function index() {
        $dataProduct = Product::get();
        $dataSupplier = Supplier::get();

        return view('pages.pembelian.index', ['title' => 'Purchase Order Page', 'dataProduct' => $dataProduct, 'dataSupplier' => $dataSupplier]);
    }

}