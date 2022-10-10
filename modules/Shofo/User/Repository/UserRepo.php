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
        return $user->update($dataArray);
    }


}
