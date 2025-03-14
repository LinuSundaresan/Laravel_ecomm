<?php

namespace App\Repositories;

use App\Interfaces\AdminVendorProfileRepositoryInterface;

use App\Models\Vendor;

class AdminVendorProfileRepository implements AdminVendorProfileRepositoryInterface
{
    public function create( $data)
    {

    }
    public function getByUserId( $id)
    {
        return $user= Vendor::where('user_id',$id)->first();
    }
}
