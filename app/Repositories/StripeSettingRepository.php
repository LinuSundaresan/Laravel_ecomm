<?php

namespace App\Repositories;

use App\Interfaces\StripeSettingRepositoryInterface;

use App\Models\StripeSetting;

class StripeSettingRepository implements StripeSettingRepositoryInterface
{
    public function getStripeSettings()
    {
        return StripeSetting::first();
    }

    public function update($id, array $data)
    {
        StripeSetting::updateOrCreate(
            ['id'=> $id],
            $data
         );
    }
}
