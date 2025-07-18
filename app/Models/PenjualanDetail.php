<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $guarded = ['id'];

    protected $table = 'penjualan_detail';

    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function penjualan() {
        return $this->belongsTo(Penjualan::class);
    }
}
