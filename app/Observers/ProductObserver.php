<?php

namespace App\Observers;

use App\Models\Product;

use illuminate\Support\Facades\Storage;

use App\Traits\ImageUploadTrait;

class ProductObserver
{

    use ImageUploadTrait;


    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        // Delete thumbnail image
        if ($product->thumb_image) {
            $this->deleteImage($product->thumb_image);
        }

        // Delete gallery images and their DB records
        foreach ($product->galleryImages as $image) {
            if ($image->image) {
                $this->deleteImage($image->image);
            }
            $image->delete();
        }

        // Delete variants and their items
        foreach ($product->variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
