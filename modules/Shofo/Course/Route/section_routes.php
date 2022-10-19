<?php

use Shofo\Course\Http\Controllers\CourseController;
use Shofo\Course\Http\Controllers\SectionController;

Route::group([
    'namespace' => 'Shofo\Course\Http\Controllers',
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'verified']
], function ($router) {
    $router->patch('/sections/{section}/accept',
        [SectionController::class, 'accept'])->name('sections.accept');

    $router->patch('/sections/{section}/reject',
        [SectionController::class, 'reject'])->name('sections.reject');

    $router->post('sections/{course}/store', [SectionController::class, 'store'])
        ->name('sections.store');
    $router->get('sections/{section}/edit', [SectionController::class, 'edit'])
        ->name('sections.edit');
    $router->patch('sections/{section}/update', [SectionController::class, 'update'])
        ->name('sections.update');
});
