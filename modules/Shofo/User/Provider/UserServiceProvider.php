<?php

namespace Shofo\User\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Shofo\User\Models\User;

class UserServiceProvider extends ServiceProvider
{


    public function register()
    {
        config()->set('auth.providers.users.model', User::class);

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
    }

}
