<?php

Route::group([
    'namespace' => 'Shofo\Dashboard\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->get('/panel',
        [\Shofo\Dashboard\Http\Controllers\DashboardController::class, 'home'])
        ->name('panel');
});



