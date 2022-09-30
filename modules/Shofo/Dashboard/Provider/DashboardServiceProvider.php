<?php

namespace Shofo\Dashboard\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Shofo\User\Models\User;

class DashboardServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/dashboard_route.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
        $this->mergeConfigFrom(__DIR__ . '/../Config/sidebar.php', 'sidebar');
    }

    public function boot()
    {
        $this->app->booted(function () {
            config()->set('sidebar.items.dashboard',
                [
                    'title' => 'پیشخوان',
                    'icon' => ' i-dashboard ',
                    'url' => route('panel')
                ]);
        });
    }

}
