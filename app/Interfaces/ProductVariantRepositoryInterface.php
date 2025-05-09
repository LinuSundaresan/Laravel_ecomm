<?php

namespace App\Interfaces;

interface ProductVariantRepositoryInterface
{
    public function create(array $data);

    public function getById($id);

    public function update($data, $id);

    public function updateStatus($data, $id);

    public function delete($id);

    public function getProductByVariant($id);
}
