<?php

namespace App\Interfaces;

interface FlashSaleRepositoryInterface
{
    public function createFlashSale(array $data);
    public function getFlashSale();
}
