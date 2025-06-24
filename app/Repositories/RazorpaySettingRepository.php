<?php

namespace App\Repositories;

use App\Interfaces\RazorpaySettingRepositoryInterface;
use App\Models\RazorpaySetting;

class RazorpaySettingRepository implements RazorpaySettingRepositoryInterface
{
    public function getRazorpaySettings()
    {
        return RazorpaySetting::first();
    }
    public function update($id, array $data)
    {
        RazorpaySetting::updateOrCreate(
            ['id'=> $id],
            $data
        );
    }
}
