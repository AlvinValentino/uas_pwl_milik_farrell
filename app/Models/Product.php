<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    protected $table = 'products';

    public $timestamps = false;

    public function product_category() {
        return $this->belongsTo(ProductCategory::class);
    }
}
