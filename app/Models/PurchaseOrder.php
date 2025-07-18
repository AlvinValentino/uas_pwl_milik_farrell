<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = ['id'];

    protected $table = 'purchase_orders';

    public $timestamps = false;

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_order_detail() {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}