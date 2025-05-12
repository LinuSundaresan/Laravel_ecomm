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

    public function getById($id)
    {
        return Product::findOrFail($id);
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
}
