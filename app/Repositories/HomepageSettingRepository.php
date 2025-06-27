<?php

namespace App\Repositories;

use App\Interfaces\HomepageSettingRepositoryInterface;
use App\Models\HomepageSetting;

class HomepageSettingRepository implements HomepageSettingRepositoryInterface
{
    public function updatePopularCategories(array $data)
    {
        HomepageSetting::updateOrCreate(
            [
                'key'   =>  'popular_category_section',
            ],
            [
                'value' =>  json_encode($data)
            ]
        );
    }

    public function getPopularCategories()
    {
        return HomepageSetting::where('key', 'popular_category_section')->first();
    }
}
