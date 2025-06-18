<?php

namespace App\Repositories;

use App\Interfaces\OrderProductRepositoryInterface;

use App\Models\OrderProduct;

class OrderProductRepository implements OrderProductRepositoryInterface
{

    public function store(array $data)
    {
        OrderProduct::create($data);
    }
}
