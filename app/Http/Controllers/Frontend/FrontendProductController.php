<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    /**Show product detail page */
    public function showProduct(string $slug)
    {
        $product = app(ProductRepositoryInterface::class)->getBySlug($slug);
        return view('frontend.pages.product-detail' , compact(
            'product'
        ));
    }

}
