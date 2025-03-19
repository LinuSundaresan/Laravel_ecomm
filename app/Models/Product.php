<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'thumb_image',
        'name',
        'slug',
        'vendor_id',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'qty',
        'short_description',
        'long_description',
        'sku',
        'price',
        'status',
        'product_type'
    ];
}
