<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;

use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function create(array $data)
    {
        Brand::create($data);
    }

    public function getById($id)
    {
        return Brand::findOrFail($id);
    }

    public function update(array $data , $id)
    {
        $brand = Brand::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        Brand::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        Brand::find($id)->update( $data );
    }
}
