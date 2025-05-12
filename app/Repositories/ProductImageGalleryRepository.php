<?php
namespace App\Repositories;

use App\Models\ProductImageGallery;

use App\Interfaces\ProductImageGalleryRepositoryInterface;

class ProductImageGalleryRepository implements ProductImageGalleryRepositoryInterface
{
    public function create($data)
    {
        ProductImageGallery::create($data);
    }

    public function getById($id)
    {
        return ProductImageGallery::findOrFail($id);
    }

    public function delete($id)
    {
        ProductImageGallery::findOrFail($id)->delete();
    }

    public function getAllGaleryByProductId($productId)
    {
        $gallery = ProductImageGallery::where('product_id', $productId)->get();
        return $gallery;
    }
}
