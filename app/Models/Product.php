<?php

namespace App\Models;

use App\Models\Laporan\LaporanStok;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    protected $table = 'products';

    public $timestamps = false;

    public function product_category() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function laporan_stok() {
        return $this->hasMany(LaporanStok::class);
    }

    public function penjualan_detail() {
        return $this->hasMany(PenjualanDetail::class);
    }
}
