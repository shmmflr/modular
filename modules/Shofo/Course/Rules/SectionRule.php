<?php

namespace Shofo\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use Shofo\Course\Repository\SectionRepo;
use Shofo\RolePermission\Models\Permission;
use Shofo\RolePermission\Models\Role;
use Shofo\User\Repository\UserRepo;

class SectionRule implements Rule
{

    public function passes($attribute, $value)
    {
        $section = resolve(SectionRepo::class)->findByIdAndCourse($value, request()->route('course'));
        if ($section) {
            return true;
        }
        return false;

    }

    public function message()
    {
        return 'چنین سر فصلی وجود ندارد!!!';
    }
}
