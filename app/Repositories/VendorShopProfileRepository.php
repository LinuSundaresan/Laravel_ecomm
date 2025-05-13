<?php

namespace App\Repositories;

use App\Models\Vendor;

use App\Interfaces\VendorShopProfileRepositoryInterface;

class VendorShopProfileRepository implements VendorShopProfileRepositoryInterface
{

    public function update($data , $id)
    {
        Vendor::where('user_id',$id)->update($data);
    }
}
