<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = ['id'];

    protected $table = 'product_categories';

    public $timestamps = false;

    public function product() {
        return $this->hasMany(Product::class);
    }
}
