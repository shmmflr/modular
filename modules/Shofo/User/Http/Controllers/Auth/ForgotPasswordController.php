<?php

namespace Shofo\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Shofo\User\Helper\VerifyCodeHelper;
use Shofo\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use Shofo\User\Http\Requests\sendVerifyCodeRequestEmailRequest;
use Shofo\User\Repository\UserRepo;

class
ForgotPasswordController extends Controller
{


    use SendsPasswordResetEmails;

    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.passwords.email');
    }

    public function sendVerifyCodeRequestEmail(sendVerifyCodeRequestEmailRequest $request)
    {
//1.باید وجود کاربر چک شود
//2.اگر کاربر وجود داشت کد براش ارسال بشه

        $user = resolve(UserRepo::class)->findByEmail($request->get('email'));

        if ($user && !VerifyCodeHelper::hasCode($user->id)) {
            $user->sendResetPasswordRequestNotification();
        }
        return view('User::Front.passwords.verifyCodeResetPassword');
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {

        $user = resolve(UserRepo::class)->findByEmail($request->get('email'));
        if ($user == null || !VerifyCodeHelper::check($user->id, $request->get('verify_code'))) {
            return back()->withErrors(['verify_code' => 'کد وارد شده معتبر نمیباشد!']);
        }
        auth()->loginUsingId($user->id);
        return view('User::Front.passwords.reset');
    }
}
