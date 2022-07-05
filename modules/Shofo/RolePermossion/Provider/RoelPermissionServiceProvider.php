<?php

namespace Shofo\RolePermission\Provider;

use Illuminate\Support\ServiceProvider;

class RoelPermissionServiceProvider extends ServiceProvider
{


    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/role_permission_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermission');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang');
    }

}
