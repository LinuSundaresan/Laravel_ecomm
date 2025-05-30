<?php

namespace App\Repositories;

use App\Models\GeneralSetting;

use App\Interfaces\GeneralSettingRepositoryInterface;

class GeneralSettingRepository implements GeneralSettingRepositoryInterface
{

    public function getGeneralSetting()
    {
        return GeneralSetting::first();
    }

    public function updateGeneralSetting(array $data)
    {
        GeneralSetting::updateOrCreate(['id'=> 1] , $data );
    }
}
