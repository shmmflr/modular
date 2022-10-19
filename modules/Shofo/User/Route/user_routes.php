<?php

use Shofo\User\Http\Controllers\Auth\ForgotPasswordController;
use Shofo\User\Http\Controllers\Auth\LoginController;
use Shofo\User\Http\Controllers\Auth\RegisterController;
use Shofo\User\Http\Controllers\Auth\ResetPasswordController;
use Shofo\User\Http\Controllers\Auth\VerificationController;
use Shofo\User\Http\Controllers\UserController;

Route::group([
    'namespace' => 'Shofo\User\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'dashboard'
], function ($router) {
    Route::resource('users', "UserController");
    Route::post('/users/{user}/addRole', [UserController::class, 'addRoles'])->name('users.addRole');
    Route::patch('/users/{user}/verifyEmail', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::delete('users/{user}/{role}/removeRole',
        [UserController::class, 'removeRole'])->name('users.removeRole');
    Route::post('/users/photo', [UserController::class, 'uploadPhoto'])
        ->name('users.photo');
    Route::get('edit/profile', [UserController::class, 'editProfile'])->name('edit.profile');
    Route::get('tutors/{username}', [UserController::class, 'viewProfile'])->name('view.profile');
    Route::post('update/profile', [UserController::class, 'updateProfile'])->name('update.profile');
});


Route::group([
    'namespace' => 'Shofo\User\Http\Controllers',
    'middleware' => 'web'
], function ($router) {
//    Auth::routes(['verify' => true]);


    Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');

//    Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

//    Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//    Resend Password
    /*
     * از اینجا میره به صفحه ای که ایمیل را برای دریافت کد فعال سازی میگیرد
     * */
    Route::get('/password/reset', [ForgotPasswordController::class, 'showVerifyCodeRequestForm'])
        ->name('password.request');
    /*
   * از اینجا آدرس ایمیل رو میدیم و کد فعال سازی برای ما ارسال میشه
   * */
    Route::get('/password/resent/send', [ForgotPasswordController::class, 'sendVerifyCodeRequestEmail'])
        ->name('send.verify.code.email');
    /*
     * چک کرن صحیح بودن کد ارسالی
     * */
    Route::post('/password/resent/check-verify-code', [ForgotPasswordController::class, 'checkVerifyCode'])
        ->name('check.verify.code')->middleware('throttle:5,1');
    /*
     * حالا ما کد را ابتدا دریافت کردیم و صحیح واردش کردم
     * و وارد صفحه تغییر رمز عبور شدیم
     * */
    Route::get('/password/change', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.showResetForm')->middleware('auth');
    Route::post('/password/change', [ResetPasswordController::class, 'reset'])
        ->name('password.update');


//    Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});
