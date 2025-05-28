<?php

namespace App\Repositories;

use App\Interfaces\FlashSaleRepositoryInterface;

use App\Models\FlashSale;

class FlashSaleRepository implements FlashSaleRepositoryInterface
{
    public function createFlashSale(array $data)
    {
        FlashSale::updateOrCreate(
            ['id'=> 1] , $data
        );
    }

    public function getFlashSale()
    {
        return FlashSale::first();
    }
}
