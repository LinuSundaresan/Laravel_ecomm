<?php

namespace App\Repositories;

use App\Interfaces\FlashSaleItemRepositoryInterface;

use App\Models\FlashSaleItem;

class FlashSaleItemRepository implements FlashSaleItemRepositoryInterface
{

    public function addProductToFlashSale(array $data)
    {
        FlashSaleItem::updateOrCreate($data);
    }

    public function getFlashSaleHomeItems()
    {
        return FlashSaleItem::where('status', 1)->where('show_at_home' , 1)->orderBy('id', 'ASC')->get();
    }

    public function getFlashSalePageItems()
    {
        return FlashSaleItem::where('status', 1)->orderBy('id', 'ASC')->paginate(20);
    }

    public function updateInHomeStatus(array $data, $id)
    {
        FlashSaleItem::find($id)->update($data);
    }

    public function updateStatus(array $data, $id)
    {
        FlashSaleItem::find($id)->update($data);
    }

    public function deleteItem($id)
    {
        FlashSaleItem::find($id)->delete();
    }

}
