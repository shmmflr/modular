<?php

namespace Shofo\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Shofo\RolePermission\Models\Permission;


class SectionPolicy
{

    use HandlesAuthorization;


    public
    function edit($user, $section)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $user->id == $section->course->teacher_id
        ) {
            return true;
        }
    }

    function confirmStatus($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            ? true
            : null;
    }

    public
    function destroy($user, $section)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $user->id == $section->course->teacher_id
        ) {
            return true;
        }
    }

    public
    function destails($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $user->id == $course->teacher_id
        ) {
            return true;
        }
    }
}
