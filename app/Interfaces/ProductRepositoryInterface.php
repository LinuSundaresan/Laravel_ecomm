<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function update($data , $id);
    public function delete($id);
    public function updateStatus($data , $id);
}
