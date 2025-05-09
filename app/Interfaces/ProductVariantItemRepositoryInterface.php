<?php

namespace App\Interfaces;

interface ProductVariantItemRepositoryInterface
{
    public function create(array $data);
    public function getById(string $id);
}
