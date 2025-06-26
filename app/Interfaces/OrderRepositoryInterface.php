<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function store($data);
    public function getById(string $id);
    public function getByIdwithUser(string $id);
    public function updateOrderStatus($data, string $id);
    public function updatePaymentStatus($data, string $id);
    public function deleteOrdersWithDependencies($id);
}
