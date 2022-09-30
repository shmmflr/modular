<?php

namespace Shofo\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use Shofo\RolePermission\Models\Permission;
use Shofo\RolePermission\Models\Role;
use Shofo\User\Repository\UserRepo;

class TeacherRule implements Rule
{

    public function passes($attribute, $value)
    {
        $user = resolve(UserRepo::class)->findById($value);
//        $userRepo = new UserRepo();
//        $user = $userRepo->findById($value);
        return $user->hasPermissionTo(Permission::PERMISSION_TEACH);
    }

    public function message()
    {
        return 'کاربر مورد نظر مجوز تدریس ندارد.';
    }
}
