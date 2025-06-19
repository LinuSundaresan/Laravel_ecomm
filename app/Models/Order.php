<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_id',
        'user_id',
        'sub_total',
        'amount',
        'currency_name',
        'currency_icon',
        'product_qty',
        'payment_method',
        'payment_status',
        'order_address',
        'shipping_method',
        'coupen',
        'order-status'
    ];
}
