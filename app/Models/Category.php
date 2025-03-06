<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'icon',
        'name',
        'slug',
        'status'
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
