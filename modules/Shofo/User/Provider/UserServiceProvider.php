<?php

namespace Shofo\User\Provider;

use App\Http\Middleware\StoreUserIp;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Shofo\RolePermission\Models\Permission;
use Shofo\User\Database\Seeders\UserSeeder;
use Shofo\User\Models\User;
use Shofo\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);


        config()->set('auth.providers.users.model', User::class);

        DatabaseSeeder::$seeders[] = UserSeeder::class;
        Gate::policy(User::class, UserPolicy::class);

    }

    public function boot()
    {
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "title" => "کاربران",
            "url" => route('users.index'),
            "permission" => Permission::PERMISSION_MANAGE_USERS,
        ]);
        $this->app->booted(function () {
            config()->set('sidebar.items.profile', [
                "icon" => "i-user__inforamtion",
                "title" => "اطلاعات کاربری",
                "url" => route('edit.profile'),
            ]);
        });

    }

}
