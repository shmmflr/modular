<?php

namespace Shofo\Media\Provider;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/media_route.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Media');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang/');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang/', 'Media');
    }


    public function boot()
    {
        //
    }
}
