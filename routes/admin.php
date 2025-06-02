<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CoupenController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;


use Illuminate\Support\Facades\Route;

/**Admin Routes */
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('dashboard' , [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile' , [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update' , [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update' , [ProfileController::class, 'passwordUpdate'])->name('password.update');

    //slider routes
    Route::resource('slider', SliderController::class);

    //category routes
    Route::put('category/update-status', [CategoryController::class, 'updateStatus'])->name('category.update-status');
    Route::resource('category', CategoryController::class);

    //subcategory routes
    Route::put('sub-category/update-status', [SubCategoryController::class, 'updateStatus'])->name('sub-category.update-status');
    Route::resource('sub-category', SubCategoryController::class);

    //childcategory routes
    Route::put('child-category/update-status', [ChildCategoryController::class, 'updateStatus'])->name('child-category.update-status');
    Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
    Route::resource('child-category', ChildCategoryController::class);

    //brand routes
    Route::put('brand/update-status', [BrandController::class, 'updateStatus'])->name('brand.update-status');
    Route::resource('brand', BrandController::class);

    //Vendor Profile routes
    Route::resource('vendor-profile', AdminVendorProfileController::class);

    //products routes
    Route::get('product/get-subcategories' , [ProductController::class , 'getSubCategories'])->name('product.get-subcategories');
    Route::get('product/get-child-categories' , [ProductController::class , 'getChildCategories'])->name('product.get-child-categories');
    Route::put('product/update-status', [ProductController::class, 'updateStatus'])->name('product.update-status');
    Route::resource('products', ProductController::class);

    //products gallery routes
    Route::resource('products-image-gallery', ProductImageGalleryController::class);

    //products variant routes
    Route::put('products-variant/update-status', [ProductVariantController::class, 'updateStatus'])->name('products-variant.update-status');
    Route::resource('products-variant', ProductVariantController::class);

    //product variant item routes
    Route::put('products-variant-item/update-status', [ProductVariantItemController::class, 'updateStatus'])->name('products-variant-item.update-status');
    Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
    Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
    Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
    Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
    Route::put('products-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');


    //seller product routes
    Route::get('seller-products' , [SellerProductController::class , 'index'])->name('seller-products.index');
    Route::get('seller-pending-products' , [SellerProductController::class , 'pendingProducts'])->name('seller-pending-products.index');
    Route::put('change-approve-status' , [SellerProductController::class , 'changeApproveStatus'])->name('change-approve-status');

    //Flash sale routes
    Route::get('flash-sale' , [FlashSaleController::class , 'index'])->name('flash-sale.index');
    Route::put('flash-sale' , [FlashSaleController::class , 'update'])->name('flash-sale.update');
    Route::post('flash-sale/add-product' , [FlashSaleController::class , 'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale/show-at-home/status-change' , [FlashSaleController::class , 'changeShowatHomeStatus'])->name('flash-sale.show-at-home.change-status');
    Route::put('flash-sale-status' , [FlashSaleController::class , 'changeStatus'])->name('flash-sale-status');
    Route::delete('flash-sale/{id}' , [FlashSaleController::class , 'destroy'])->name('flash-sale.destroy');

    //Settings routes
    Route::get('settings', [SettingsController::class , 'index'])->name('settings.index');
    Route::put('general-setting-update', [SettingsController::class , 'generalSettingUpdate'])->name('general-settings-update');

    //Coupen Routes
    Route::put('coupens/update-status', [CoupenController::class, 'updateStatus'])->name('coupens.update-status');
    Route::resource('coupens', CoupenController::class);

    //Shipping Rules Routes
    Route::put('shipping-rule/update-status', [ShippingRuleController::class, 'updateStatus'])->name('shipping-rule.update-status');
    Route::resource('shipping-rule', ShippingRuleController::class);

});


Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

/**Admin Routes */
