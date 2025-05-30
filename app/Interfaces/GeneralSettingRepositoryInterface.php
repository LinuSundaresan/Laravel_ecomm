<?php

namespace App\Interfaces;

interface GeneralSettingRepositoryInterface
{
    public function getGeneralSetting();
    public function updateGeneralSetting(array $data);
}
