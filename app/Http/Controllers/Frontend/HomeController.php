<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSale();
        $flashSaleHomeItems = app(FlashSaleItemRepositoryInterface::class)->getFlashSaleHomeItems();
        return view('frontend.home.home', compact(
            'sliders' ,
            'flashSaleDate',
            'flashSaleHomeItems'
        ));
    }
}
