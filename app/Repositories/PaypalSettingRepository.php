<?php

namespace App\Repositories;

use App\Models\PaypalSetting;

use App\Interfaces\PaypalSettingRepositoryInterface;

class PaypalSettingRepository implements PaypalSettingRepositoryInterface
{

    public function getPaypalSettings()
    {
        return PaypalSetting::first();
    }

    public function update($id, array $data)
    {
        PaypalSetting::updateOrCreate(
            ['id'=> $id],
            $data
         );
    }
}
