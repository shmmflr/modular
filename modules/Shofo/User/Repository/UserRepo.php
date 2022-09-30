<?php

namespace Shofo\User\Repository;

use Shofo\User\Models\User;

class UserRepo
{


    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function teachers()
    {
        return User::permission('teach')->get();
    }

    public function findById($id)
    {
        return User::find($id);
    }


}
