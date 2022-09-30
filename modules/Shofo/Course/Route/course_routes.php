<?php

use Shofo\Course\Http\Controllers\CourseController;

Route::group([
    'namespace' => 'Shofo\Course\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->resource('/course', CourseController::class);
});
