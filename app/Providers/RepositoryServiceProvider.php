<?php

namespace App\Providers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Repositories\Interfaces\ResetPasswordRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ResetPasswordRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ResetPasswordRepositoryInterface::class, ResetPasswordRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
