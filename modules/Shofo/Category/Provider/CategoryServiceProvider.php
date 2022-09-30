<?php

namespace Shofo\Category\Provider;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/category_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang/');
    }

    public function boot()
    {

        config()->set('sidebar.items.categories',
            [
                'title' => 'دسته بندی ها',
                'icon' => ' i-categories',
                'url' => route('category.index')
            ]);
    }

}
