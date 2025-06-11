<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\UserAddressContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

/**Product Details */
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
/**Product Details */

/**cart routes */
Route::post('add-to-cart' , [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details' , [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity' , [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart' , [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rawid}' , [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count' , [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products' , [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-products' , [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-products');
Route::get('cart/sidebar-products-total' , [CartController::class, 'CartTotal'])->name('cart.sidebar-products-total');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user' , 'as'=>'.user'], function(){
//     Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
//     Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
// });

Route::prefix('user')->middleware(['auth', 'verified'])->name('user.')->group(function () {
    Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile' , [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile' , [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    /**User address route */
    Route::resource('address', UserAddressContoller::class);



});

// Route::get('vendor/dashboard' , [VendorController::class, 'dashboard'])->middleware('auth', 'role:vendor')->name('vendor.dashboard');

Route::prefix('vendor')->middleware('auth', 'role:vendor')->name('vendor.')->group(function(){
    Route::get('dashboard' , [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('profile' , [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile' , [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile' , [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

    /*vendor shop profile*/
    Route::resource('shop-profile', VendorShopProfileController::class);

    //products routes
    Route::get('product/get-subcategories' , [VendorProductController::class , 'getSubCategories'])->name('product.get-subcategories');
    Route::get('product/get-child-categories' , [VendorProductController::class , 'getChildCategories'])->name('product.get-child-categories');
    Route::put('product/update-status', [VendorProductController::class, 'updateStatus'])->name('product.update-status');
    Route::resource('products', VendorProductController::class);

    Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

    //products variant routes
    Route::put('products-variant/update-status', [VendorProductVariantController::class, 'updateStatus'])->name('products-variant.update-status');
    Route::resource('products-variant', VendorProductVariantController::class);

    /* product variant item routes */
    Route::put('products-variant-item/update-status', [VendorProductVariantItemController::class, 'updateStatus'])->name('products-variant-item.update-status');
    Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');
    Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
    Route::put('products-variant-item-update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');
    Route::delete('products-variant-item/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
    Route::put('products-variant-item-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');

});

require __DIR__.'/admin.php';
