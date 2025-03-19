<?php

namespace App\Repositories;

use App\Models\Product;

use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data)
    {
       // dd($data);
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
}
