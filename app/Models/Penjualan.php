<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = ['id'];

    protected $table = 'penjualan';

    public $timestamps = false;
}
