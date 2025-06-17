<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCoupenRequest;
use App\Interfaces\CoupenRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /***Add item to cart */
    public function addToCart(Request $request)
    {
        $product = app(ProductRepositoryInterface::class)->getById($request->product_id);

        //check product quantity
        if($product->qty == 0) {
            return response(['status'=>'error', 'message' => 'Product Stock Out']);
        } else if($product->qty < $request->qty){
            return response(['status'=>'error', 'message' => 'Quantity not available in our stock']);
        }

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

        if(count($cartItems) == 0){
            Session::forget('coupen');
        }

        return view('frontend.pages.cart-details' , compact(
            'cartItems'
        ));
    }

    /***Update Product Qty */

    public function updateProductQty(Request $request)
    {
        $product_id = Cart::get($request->rowId)->id;
        $product = app(ProductRepositoryInterface::class)->getById($product_id);

        //check product quantity
        if($product->qty == 0) {
            return response(['status'=>'error', 'message' => 'Product Stock Out']);
        } else if($product->qty < $request->qty){
            return response(['status'=>'error', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $product_total = $this->getProductTotal($request->rowId);
        return response(['status'=>'success', 'message' => 'Product quantity updated', 'product_total'=>$product_total]);
    }

    /***Clear cart prducts */
    public function clearCart()
    {
        Cart::destroy();
        return response(['status'=>'success', 'message' => 'Cart cleared succesfully']);
    }

    /***Remove Product from cart */
    public function removeProduct($rawId)
    {
        Cart::remove($rawId);
        toastr('Product Removed Succesfully!', 'success');
        return redirect()->back();
    }

    /*** Get Cart Count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }


    /***get all cart products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /***remove sidebar product ajax */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status'=>'success', 'message' => 'Product removed succesfully']);
    }

    /***get Product Total */
    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /***Get Cart Total */
    public function CartTotal()
    {
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }

    /***Apply coupen */
    public function applyCoupen(ApplyCoupenRequest $request)
    {
        if($request->coupen_code == null){
            return response(['status'=> 'error', 'message' => 'Coupen Field is required']);
        }

        $coupen = app(CoupenRepositoryInterface::class)->getActiveCoupenByCode($request->coupen_code);

        if($coupen == null) {
            return response(['status'=> 'error', 'message' => 'Invalid Coupen']);
        } elseif($coupen->start_date > date('Y-m-d')) {
            return response(['status'=> 'error', 'message' => 'Invalid Coupen']);
        } elseif($coupen->end_date < date('Y-m-d')) {
            return response(['status'=> 'error', 'message' => 'Coupen has been expired']);
        } elseif($coupen->total_used >= $coupen->max_use){
            return response(['status'=> 'error', 'message' => 'You can not apply this coupen']);
        }

        if($coupen->discount_type == 'amount'){
            Session::put('coupen', [
                'coupen_name' => $coupen->name,
                'coupen_code' => $coupen->code,
                'discount_type' => 'amount',
                'discount' => $coupen->discount,
            ]);
        } else if($coupen->discount_type == 'percent'){
            Session::put('coupen', [
                'coupen_name' => $coupen->name,
                'coupen_code' => $coupen->code,
                'discount_type' => 'percent',
                'discount' => $coupen->discount,
            ]);
        }

        return response(['status' => 'success', 'message'=> 'Coupen applied successfully']);
    }

    /***Calculate Coupen Discount */
    public function coupenCalculation()
    {
        if(Session::has('coupen')){
            $coupen = Session::get('coupen');
            $subTotal = getCartTotal();
            if($coupen['discount_type'] == 'amount'){
                $total = $subTotal-$coupen['discount'];
                return response(['status'=>'success' , 'cart_total' => $total , 'discount'=>$coupen['discount']]);
            } else if($coupen['discount_type'] == 'percent'){
                //$discount = $subTotal-(($subTotal*$coupen['discount'])/100);
                $discount = $subTotal*$coupen['discount']/100;
                $total = $subTotal-$discount;
                return response(['status'=>'success' , 'cart_total' => $total , 'discount'=>$discount]);
            }

        } else {
            $total = getCartTotal();
            return response(['status'=>'success' , 'cart_total' => $total , 'discount'=> 0]);
        }
    }
}
