<?php

namespace Shofo\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Shofo\User\Helper\VerifyCodeHelper;
use Shofo\User\Mail\ResetPasswordRequestEmail;
use Shofo\User\Mail\VerifyEmailCode;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return ResetPasswordRequestEmail
     */
    public function toMail($notifiable)
    {
        $code = VerifyCodeHelper::generateCode();

        VerifyCodeHelper::storeCache($notifiable->id, $code, 120);

        return (new ResetPasswordRequestEmail($code))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
