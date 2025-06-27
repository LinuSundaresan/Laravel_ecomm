<?php

namespace App\Interfaces;

interface HomepageSettingRepositoryInterface
{
    public function updatePopularCategories(array $data);
    public function getPopularCategories();
}
