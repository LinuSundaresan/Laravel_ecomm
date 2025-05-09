<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    protected $fillable = [
        'product_variant_id',
        'name',
        'price',
        'is_default',
        'status'
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
