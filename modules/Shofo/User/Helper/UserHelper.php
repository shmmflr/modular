<?php

namespace Shofo\User\Helper;

class UserHelper
{
    public static function changePassword($user, $newPassword)
    {
        $user->password = bcrypt($newPassword);
        $user->save();
    }

}
