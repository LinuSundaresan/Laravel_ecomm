<?php

namespace App\Repositories;

use App\Interfaces\ChildCategoryRepositoryInterface;

use App\Models\ChildCategory;

class ChildCategoryRepository implements ChildCategoryRepositoryInterface
{
    public function create(array $data)
    {
        ChildCategory::create($data);
    }

    public function getById($id)
    {
        return ChildCategory::findOrFail($id);
    }

    public function update($data , $id)
    {
        ChildCategory::findOrFail($id)->update($data);
    }

    public function delete( $id)
    {
        ChildCategory::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        ChildCategory::find($id)->update( $data );
    }

    public function getChildCategoryCountBySubCategoryId($id)
    {
        return ChildCategory::where('sub_category_id', $id)->where('status', 1)->count();
    }

    public function getChildCategoryBySubCategoryId($id)
    {
        return ChildCategory::where('sub_category_id', $id)->get();
    }

    public  function getAll()
    {
        return ChildCategory::all();
    }
}
