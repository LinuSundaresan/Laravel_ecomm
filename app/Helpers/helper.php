<?php

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
