<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    protected $fillable = [
        'image',
        'product_id',
    ];
}
