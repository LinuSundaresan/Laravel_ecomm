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

    public function getById(string $id)
    {
        return Order::findOrFail($id);
    }

    public function getByIdwithUser(string $id)
    {
        return Order::with(['user'])->findOrFail($id);
    }

    public function updateOrderStatus($data , $id)
    {
        $status = ['order_status' => $data];
        Order::findOrFail($id)->update($status);
    }

    public function updatePaymentStatus($data , $id)
    {
        $status = ['payment_status' => $data];
        Order::findOrFail($id)->update($status);
    }

    public function deleteOrdersWithDependencies($id)
    {
        Order::findOrFail($id)->delete();
    }

}
