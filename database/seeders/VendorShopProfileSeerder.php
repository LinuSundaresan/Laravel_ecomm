<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeerder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@yopmail.com')->first();

        $vendor = new Vendor();

        $vendor->banner = 'uploads/vendor_banner/admin_vendor_banner.png';
        $vendor->shop_name = 'Vendor Shop';
        $vendor->phone = '1234456';
        $vendor->email = 'vendor@yopmail.com';
        $vendor->address = 'India ';
        $vendor->description = 'Shop Admin';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
