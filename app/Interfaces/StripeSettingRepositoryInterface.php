<?php

namespace App\Interfaces;

interface StripeSettingRepositoryInterface
{
    public function getStripeSettings();
    public function update($id, array $data);
}
