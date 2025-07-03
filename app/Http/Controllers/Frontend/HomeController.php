<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\HomepageSettingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSale();
        $flashSaleHomeItems = app(FlashSaleItemRepositoryInterface::class)->getFlashSaleHomeItems();
        $popularCategories = app(HomepageSettingRepositoryInterface::class)->getPopularCategories();
        $brands = app(BrandRepositoryInterface::class)->getAll();
        $typeBasedProducts = $this->typeBasedProducts();
        return view('frontend.home.home', compact(
            'sliders' ,
            'flashSaleDate',
            'flashSaleHomeItems',
            'popularCategories',
            'brands',
            'typeBasedProducts'
        ));
    }

    public function typeBasedProducts()
    {
        $typeBasedProducts = [];

        $typeBasedProducts['new_arrival'] = app(ProductRepositoryInterface::class)->getTypeBasedProducts('new_arrival');
        $typeBasedProducts['featured_product'] = app(ProductRepositoryInterface::class)->getTypeBasedProducts('featured_product');
        $typeBasedProducts['top_product'] = app(ProductRepositoryInterface::class)->getTypeBasedProducts('top_product');
        $typeBasedProducts['best_product'] = app(ProductRepositoryInterface::class)->getTypeBasedProducts('best_product');

        return $typeBasedProducts;
    }
}
