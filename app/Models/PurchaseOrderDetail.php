<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $guarded = ['id'];

    protected $table = 'purchase_order_details';

    public $timestamps = false;

    public function purchase_order() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
