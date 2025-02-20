<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                "name" => "Admin User",
                "username" => "adminuser",
                "email" => "admincomm@yopmail.com",
                "role" => "admin",
                "status" => "active",
                "password" => bcrypt("password"),
            ],
            [
                "name" => "Vendor User",
                "username" => "vendoruser",
                "email" => "vendor@yopmail.com",
                "role" => "vendor",
                "status" => "active",
                "password" => bcrypt("password"),
            ],
            [
                "name" => " User",
                "username" => "user",
                "email" => "usercomm@yopmail.com",
                "role" => "user",
                "status" => "active",
                "password" => bcrypt("password"),
            ]
        ]);
    }
}
