<?php

namespace App\Interfaces;

interface ProductImageGalleryRepositoryInterface
{
    public function create($data);
    public function getById($id);
    public function delete($id);
}
