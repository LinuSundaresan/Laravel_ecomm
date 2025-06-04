<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    /***Add item to cart */
    public function addToCart(Request $request)
    {
        $product = app(ProductRepositoryInterface::class)->getById($request->product_id);

        $variants = [];
        $variantTotalAmount = 0;

        if($request->has('variants')){
            foreach($request->variants as $item_id){
                $variantItem = app(ProductVariantItemRepositoryInterface::class)->getById($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        /**check discount */
        $productPrice = 0;
        if(checkDiscount($product)){
            $productPrice += $product->offer_price;
        } else {
            $productPrice += $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice ;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        Log::info(Cart::content());

        return response(['status'=>'success', 'message' => 'Added to cart successfully ']);
    }


    /**Cart Details */
    public function cartDetails()
    {
        $cartItems = Cart::content();
        return view('frontend.pages.cart-details' , compact(
            'cartItems'
        ));
    }

    /***Update Product Qty */

    public function updateProductQty(Request $request)
    {
        Cart::update($request->rowId, $request->quantity);

        return response(['status'=>'success', 'message' => 'Product quantity updated']);
    }
}
