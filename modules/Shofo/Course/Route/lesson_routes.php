<?php

use Shofo\Course\Http\Controllers\CourseController;
use Shofo\Course\Http\Controllers\LessonController;
use Shofo\Course\Http\Controllers\SectionController;

Route::group([
    'namespace' => 'Shofo\Course\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->get('/courses/{course}/lesson/create',
        [LessonController::class, 'create'])->name('lesson.create');
    $router->post('/courses/{course}/lesson/store',
        [LessonController::class, 'store'])->name('lesson.store');
});
