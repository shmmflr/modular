<?php

use Shofo\Course\Http\Controllers\CourseController;

Route::group([
    'namespace' => 'Shofo\Course\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->resource('/course', CourseController::class);
    $router->patch('/courses/{course}/accept',
        [CourseController::class, 'accept'])->name('course.accept');

    $router->patch('/courses/{course}/reject',
        [CourseController::class, 'reject'])->name('course.reject');

    $router->get('/course/{course}/details', [
        CourseController::class, 'details'
    ])->name('course.details');
});
