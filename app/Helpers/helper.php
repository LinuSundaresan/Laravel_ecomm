<?php

use Illuminate\Support\Facades\Session;


// use Cart;

function setActive(array $routes, $activeClass = 'active')
{
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            return $activeClass;
        }
    }
    return '';
}

/** check the product have discount or not */
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');
    // If offer dates are missing, no discount
    if (empty($product->offer_start_date) || empty($product->offer_end_date || empty($product->offer_price))) {
        return false;
    }

    // Check discount validity
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

/** Calculate Discount Percentage */
function calculateDiscountPercentage($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice-$discountPrice;
    $discountPercent = ($discountAmount/$originalPrice)*100;
    return round($discountPercent);
}

/**Check the product type */
function productType($type): string
{
    switch($type){
        case 'best_product':
            return 'best';
            break;
        case 'new_arrival':
            return 'new';
            break;
        case 'featured_product':
            return 'featured';
            break;
        case 'top_product':
            return 'top';
            break;
        default:
            return '';
            break;
    }
}

/***Get Total Cart Amount */
function getCartTotal()
{
    $total = 0;
    foreach(Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

/**Get payable total amount */
function getMainCartTotal()
{
    if(Session::has('coupen')){
        $coupen = Session::get('coupen');
        $subTotal = getCartTotal();
        if($coupen['discount_type'] == 'amount'){
            $total = $subTotal-$coupen['discount'];
            return $total;
        } else if($coupen['discount_type'] == 'percent'){
            //$discount = $subTotal-(($subTotal*$coupen['discount'])/100);
            $discount = $subTotal*$coupen['discount']/100;
            $total = $subTotal-$discount;
            return $total;
        } else {
            return getCartTotal();
        }

    }
}

/**Get cart discount */
function getCartDiscount()
{
    if(Session::has('coupen')){
        $coupen = Session::get('coupen');
        $subTotal = getCartTotal();
        if($coupen['discount_type'] == 'amount'){
            return $coupen['discount'];
        } else if($coupen['discount_type'] == 'percent'){
            $discount = $subTotal*$coupen['discount']/100;
            return $discount;
        } else {
            return 0;
        }

    }
}


/**get shipping fee at cart */
function getShippingFee()
{
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    } else {
        return 0;
    }
}

/**get payable amount */
function getFinalPayableAmount()
{
    return getMainCartTotal()+getShippingFee();
}

/**Limit Text */
function limitText($text , $limit=20)
{
    return \Str::limit($text, $limit);
}
