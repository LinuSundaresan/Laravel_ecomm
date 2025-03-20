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
}
