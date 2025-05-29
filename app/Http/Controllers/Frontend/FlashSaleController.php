<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSale();
        $flashSalePageItems = app(FlashSaleItemRepositoryInterface::class)->getFlashSalePageItems();
        return view('frontend.pages.flash-sale', compact(
            'flashSaleDate',
            'flashSalePageItems'
        ));
    }
}
