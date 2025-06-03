<?php

namespace App\Providers;

use App\Interfaces\AdminVendorProfileRepositoryInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\CoupenRepositoryInterface;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Interfaces\ShippingruleRepositoryInterface;
use App\Interfaces\SliderRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\UserAddressRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Models\Product;
use App\Observers\ProductObserver;
use App\Repositories\AdminVendorProfileRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ChildCategoryRepository;
use App\Repositories\CoupenRepository;
use App\Repositories\FlashSaleItemRepository;
use App\Repositories\FlashSaleRepository;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ProductImageGalleryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantItemRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\ShippingRuleRepository;
use App\Repositories\SliderRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\UserAddressRepository;
use App\Repositories\UserRepository;
use App\Repositories\VendorShopProfileRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(FlashSaleRepositoryInterface::class , FlashSaleRepository::class);
        $this->app->bind(FlashSaleItemRepositoryInterface::class , FlashSaleItemRepository::class);
        $this->app->bind(GeneralSettingRepositoryInterface::class , GeneralSettingRepository::class);
        $this->app->bind(CoupenRepositoryInterface::class , CoupenRepository::class);
        $this->app->bind(ShippingruleRepositoryInterface::class , ShippingRuleRepository::class);
        $this->app->bind(UserAddressRepositoryInterface::class , UserAddressRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Product::observe(ProductObserver::class);
        Paginator::useBootstrap();
        $generalSetting = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();

        View::composer('*', function($view) use ($generalSetting){
            $view->with('settings', $generalSetting);
        });
    }
}
