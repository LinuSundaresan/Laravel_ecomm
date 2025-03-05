<?php

namespace App\Interfaces;

interface ChildCategoryRepositoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function update(array $data , $id);
    public function delete($id);
    public function updateStatus($data, $id);
    public function getChildCategoryCountBySubCategoryId($id);
}
