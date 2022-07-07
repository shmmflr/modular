<?php

use Shofo\Category\Http\Controllers\CategoryController;

Route::group([
    'namespace' => 'Shofo\Category\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->resource('/category', CategoryController::class);
});
