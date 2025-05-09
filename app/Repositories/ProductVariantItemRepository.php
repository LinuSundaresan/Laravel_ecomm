<?php

namespace App\Repositories;

use App\Models\ProductVariantItem;

use App\Interfaces\ProductVariantItemRepositoryInterface;

class ProductVariantItemRepository implements ProductVariantItemRepositoryInterface
{
    public function create(array $data)
    {
        ProductVariantItem::create($data);
    }

    public function getById(string $id)
    {
        return ProductVariantItem::findOrFail($id);
    }
}
