<?php

namespace App\Providers;

use App\Repositories\Contracts\IAuthRepository;
use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;
use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Contracts\IPictureRepository;
use App\Repositories\Contracts\IProductRepository;
use App\Repositories\Contracts\IRoleRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\CartInforRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\PictureRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
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
        $this->app->bind(IProductRepository::class,ProductRepository::class);
        $this->app->bind(IUserRepository::class,UserRepository::class);
        $this->app->bind(ICategoryRepository::class,CategoryRepository::class);
        $this->app->bind(IPictureRepository::class,PictureRepository::class);
        $this->app->bind(ICartRepository::class,CartRepository::class);
        $this->app->bind(ICartInforRepository::class,CartInforRepository::class);
        $this->app->bind(IRoleRepository::class,RoleRepository::class);
        
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
