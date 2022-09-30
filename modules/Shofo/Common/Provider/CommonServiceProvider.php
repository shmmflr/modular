<?php

namespace Shofo\Common\Provider;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Common');

    }

    public function boot()
    {

        require __DIR__ . '/../helpers.php';
    }
}
