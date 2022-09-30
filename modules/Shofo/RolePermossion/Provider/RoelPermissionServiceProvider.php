<?php

namespace Shofo\RolePermission\Provider;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Shofo\RolePermission\Database\Seeders\RolePermissionSeeder;
use Shofo\RolePermission\Models\Permission;
use Shofo\RolePermission\Policies\RolePermissionPolicy;
use Shofo\User\Models\User;
use Spatie\Permission\Models\Role;

class RoelPermissionServiceProvider extends ServiceProvider
{

// TODO IS CONFIG GITHUB
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/role_permission_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermission');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Lang");
        DatabaseSeeder::$seeders[] = RolePermissionSeeder::class;
        Gate::before(function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)
                ? true
                : null;
        });

        Gate::policy(Role::class, RolePermissionPolicy::class);
    }

    public function boot()
    {

        config()->set('sidebar.items.role-permissions', [
            "icon" => "i-role-permissions",
            "title" => "نقشهای کاربری",
            "url" => route('role_permissions.index'),
//            "permission" => Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        ]);
    }

}
