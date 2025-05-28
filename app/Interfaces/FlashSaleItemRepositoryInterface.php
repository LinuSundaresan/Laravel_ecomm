<?php

namespace App\Interfaces;

interface FlashSaleItemRepositoryInterface
{
    public function addProductToFlashSale(array $data);
    public function getFlashSaleHomeItems();
    public function updateInHomeStatus(array $data , $id);
    public function updateStatus(array $data , $id);
    public function deleteItem($id);
}
