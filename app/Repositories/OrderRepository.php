<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function store($data)
    {
        $order =  Order::create($data);
        return $order->id;
    }
}
