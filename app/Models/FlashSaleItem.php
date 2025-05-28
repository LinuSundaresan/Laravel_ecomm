<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{

    protected $fillable = [
        'product_id',
        'flash_sale_id',
        'show_at_home',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
