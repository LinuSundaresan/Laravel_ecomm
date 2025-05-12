<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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
});

/**Admin Routes */


// Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user' , 'as'=>'.user'], function(){
//     Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
//     Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
// });

Route::prefix('user')->middleware(['auth', 'verified'])->name('user.')->group(function () {
    Route::get('dashboard' , [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile' , [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile' , [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile' , [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
});

// Route::get('vendor/dashboard' , [VendorController::class, 'dashboard'])->middleware('auth', 'role:vendor')->name('vendor.dashboard');

Route::prefix('vendor')->middleware('auth', 'role:vendor')->name('vendor.')->group(function(){
    Route::get('dashboard' , [VendorController::class, 'dashboard'])->name('dashboard');
    // Route::get('profile' , [VendorProfileController::class, 'index'])->name('profile');
    // Route::put('profile' , [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    // Route::post('profile' , [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
