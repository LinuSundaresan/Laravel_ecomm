<?php

namespace App\Providers;

use App\Interfaces\AdminVendorProfileRepositoryInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\SliderRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Repositories\AdminVendorProfileRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ChildCategoryRepository;
use App\Repositories\ProductImageGalleryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantItemRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\SliderRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\VendorShopProfileRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class );
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class );
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class );
        $this->app->bind(SubCategoryRepositoryInterface::class,SubCategoryRepository::class);
        $this->app->bind(ChildCategoryRepositoryInterface::class,ChildCategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class , BrandRepository::class);
        $this->app->bind(AdminVendorProfileRepositoryInterface::class, AdminVendorProfileRepository::class );
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class );
        $this->app->bind(ProductImageGalleryRepositoryInterface::class, ProductImageGalleryRepository::class );
        $this->app->bind(ProductVariantRepositoryInterface::class, ProductVariantRepository::class );
        $this->app->bind(ProductVariantItemRepositoryInterface::class , ProductVariantItemRepository::class);
        $this->app->bind(VendorShopProfileRepositoryInterface::class , VendorShopProfileRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
