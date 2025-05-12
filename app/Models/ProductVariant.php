<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'name',
        'product_id',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariantItems()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
