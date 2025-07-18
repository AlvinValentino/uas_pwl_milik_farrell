<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = ['id'];

    protected $table = 'purchase_orders';

    public static function statuses()
    {
        return [
            'draft' => 'Draft',
            'ordered' => 'Ordered',
            'partial' => 'Partial',
            'received' => 'Received',
            'closed' => 'Closed',
        ];
    }
}