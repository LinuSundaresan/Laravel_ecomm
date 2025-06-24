<?php

namespace App\Interfaces;

interface RazorpaySettingRepositoryInterface
{
    public function getRazorpaySettings();
    public function update($id, array $data);
}
