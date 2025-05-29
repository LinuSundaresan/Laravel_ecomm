<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function create(array $data);
    public function getAll();
    public function getActiveProducts();
    public function getById($id);
    public function getBySlug($slug);
    public function update($data , $id);
    public function delete($id);
    public function updateStatus($data , $id);
    public function updateApproval($data , $id);
}
