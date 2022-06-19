<?php

namespace Shofo\User\Repository;

use Shofo\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }


}
