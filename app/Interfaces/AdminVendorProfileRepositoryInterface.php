<?php

namespace App\Interfaces;

interface AdminVendorProfileRepositoryInterface
{
    public function create( $data);
    public function getByUserId( $id);
}
