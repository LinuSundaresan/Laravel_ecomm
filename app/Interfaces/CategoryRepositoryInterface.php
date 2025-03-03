<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function update(array $data , $id);
    public function delete($id);
}
