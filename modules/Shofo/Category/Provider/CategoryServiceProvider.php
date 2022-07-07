<?php

namespace Shofo\Category\Provider;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{


    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/category_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
    }

}
