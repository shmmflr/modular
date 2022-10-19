<?php

namespace Shofo\User\Repository;

use Shofo\RolePermission\Models\Permission;
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
        return User::findOrFail($id);
    }

    public function update($user, $request)
    {
        $password = $request->get('password') != null ? bcrypt($request->get('password')) : $user->password;
        $dataArray = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'username' => $request->get('username'),
            'telegram' => $request->get('telegram'),
            'youtube' => $request->get('youtube'),
            'instagram' => $request->get('instagram'),
            'linkdin' => $request->get('linkdin'),
            'twitter' => $request->get('twitter'),
            'status' => $request->get('status'),
            'password' => $password,
            'image_id' => $request->get('image_id'),
            'bio' => $request->get('bio'),
        ];

        $user->syncRoles([]);
        if ($request['role']) {
            $user->assignRole($request['role']);
        }
        return $user->update($dataArray);
    }

    public function updateProfile($request)
    {
        auth()->user()->name = $request->get('name');

        if (auth()->user()->email != $request->get('email')) {
            auth()->user()->email = $request->get('email');
            auth()->user()->email_verified_at = null;
        }
        auth()->user()->mobile = $request->get('mobile');
        auth()->user()->username = $request->get('username');

        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH) ||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)
        ) {
            auth()->user()->shaba = $request->get('shaba');
            auth()->user()->card_number = $request->get('card_number');
            auth()->user()->bio = $request->get('bio');
        }

        if ($request->get('password') != null) {
            auth()->user()->password = bcrypt($request->get('password'));
        }
        auth()->user()->save();
    }


}
