<?php

namespace App\Repositories;

use App\Models\Product;

use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data)
    {
        Product::create($data);
    }

    public function getAll()
    {
        return Product::all();
    }

    public function getActiveProducts()
    {
        return Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function getBySlug($slug)
    {
        return Product::with(['vendor', 'category' , 'variants' , 'galleryImages', 'brand'])->where('slug', $slug)->where('status', 1)->first();
    }

    public function update($data , $id)
    {
        Product::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        Product::find($id)->update( $data );
    }

    public function updateApproval($data , $id)
    {
        $product = Product::find($id);
        $product->update($data);
    }
}
