<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;

use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data)
    {
        Category::create($data);
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function update($data , $id)
    {
        Category::findOrFail($id)->update($data);
    }

    public function delete( $id)
    {
        Category::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        Category::find($id)->update( $data );
    }

    public function getAll()
    {
        return Category::all();
    }

}
