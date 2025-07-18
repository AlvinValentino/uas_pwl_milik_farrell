<?php

namespace App\Models\Laporan;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class LaporanStok extends Model
{
    protected $guarded = ['id'];

    protected $table = 'laporan_stok';

    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
