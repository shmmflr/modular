<?php

namespace Shofo\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Shofo\User\Models\User;


class UserSeeder extends Seeder
{

    public function run()
    {
        // Permissions
        foreach (User::$adminUser as $user) {
            return User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt($user['password']),
                    'email_verified_at' => '2022-02-22 22:22:22'
                ]
            )->assignRole($user['role']);
        }

    }

}

