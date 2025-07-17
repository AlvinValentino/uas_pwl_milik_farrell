<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $guarded = ['id'];

    protected $table = 'penjualan_detail';

    public $timestamps = false;
}
