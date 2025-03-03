<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\SliderRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\SliderRepository;

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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
