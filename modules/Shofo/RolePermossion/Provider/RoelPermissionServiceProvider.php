<?php

namespace Shofo\RolePermission\Provider;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use Shofo\RolePermission\Database\Seeders\RolePermissionSeeder;

class RoelPermissionServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/role_permission_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermission');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang');
        DatabaseSeeder::$seeders[] = RolePermissionSeeder::class;
    }

    public function boot()
    {

        config()->set('sidebar.items.role-permissions', [
            "icon" => "i-role-permissions",
            "title" => "نقشهای کاربری",
            "url" => route('role_permissions.index'),
        ]);
    }

}
