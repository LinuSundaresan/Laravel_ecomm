<?php

namespace App\Repositories;

use App\Models\ProductVariant;

use App\Interfaces\ProductVariantRepositoryInterface;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{
    public function create(array $data)
    {
        ProductVariant::create($data);
    }

    public function getById($id)
    {
        return ProductVariant::findOrFail($id);
    }

    public function update($data, $id)
    {
        ProductVariant::find($id)->update( $data );
    }

    public function updateStatus($data, $id)
    {
        ProductVariant::findOrFail($id)->update( $data );
    }

    public function delete($id)
    {
        ProductVariant::findOrFail($id)->delete();
    }

    public function getProductByVariant($id)
    {
        return ProductVariant::findOrFail($id);
    }

    public function getProductVariantsByProduct($productId)
    {
        return ProductVariant::where('product_id', $productId)->get();
    }
}
