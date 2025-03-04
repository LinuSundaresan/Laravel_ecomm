<?php

namespace App\Repositories;

use App\Interfaces\SubCategoryRepositoryInterface;

use App\Models\SubCategory;


class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function create(array $data)
    {
        SubCategory::create($data);
    }

    public function getById($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function update($data , $id)
    {
        SubCategory::findOrFail($id)->update($data);
    }

    public function delete( $id)
    {
        SubCategory::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        SubCategory::find($id)->update( $data );
    }

    public function getAll()
    {
        return SubCategory::all();
    }

}
