<?php

Route::group([
    'namespace' => 'Shofo\User\Http\Controllers',
    'middleware' => 'web'
], function ($router) {
    Auth::routes(['verify' => true]);
});
