<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = ['id'];

    protected $table = 'penjualan';

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function penjualan_detail() {
        return $this->hasMany(PenjualanDetail::class);
    }
}
