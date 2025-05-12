<?php

namespace App\Interfaces;

interface ProductVariantItemRepositoryInterface
{
    public function create(array $data);
    public function getById(string $id);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
    public function getVariantItemCountByVariant($id);
}
