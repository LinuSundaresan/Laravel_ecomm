<?php

namespace App\Interfaces;

interface PaypalSettingRepositoryInterface
{
    public function getPaypalSettings();
    public function update($id, array $data);
}
