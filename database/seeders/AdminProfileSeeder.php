<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admincomm@yopmail.com')->first();

        $vendor = new Vendor();

        $vendor->banner = 'uploads/vendor_banner/admin_vendor_banner.png';
        $vendor->phone = '1234456';
        $vendor->email = 'admincomm@yopmail.com';
        $vendor->address = 'India ';
        $vendor->description = 'Shop Admin';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
