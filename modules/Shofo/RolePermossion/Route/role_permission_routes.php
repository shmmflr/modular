<?php

use Shofo\RolePermission\Http\Controllers\RolePermissionController;

Route::group([
    'namespace' => 'Shofo\RolePermission\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->resource('/role_permissions', RolePermissionController::class);
});
