<?php

namespace Shofo\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Shofo\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_example()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_user_login_with_email()
    {
        $this->withExceptionHandling();
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('!!AAaa22'),
        ]);
        $this->post(route('login'), [
            'username' => $user->email,
            'password' => '!!AAaa22'
        ]);

        $this->assertAuthenticated();
    }

    /**
     * @return void
     */
    public function test_can_user_login_with_username()
    {
        $this->withExceptionHandling();
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'username' => $this->faker->userName,
            'password' => bcrypt('!!AAaa22'),
        ]);
        $this->post(route('login'), [
            'username' => $user->username,
            'password' => '!!AAaa22'
        ]);

        $this->assertAuthenticated();
    }

    /**
     * @return void
     */
    public function test_can_user_login_with_mobile()
    {
        $this->withExceptionHandling();
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'username' => $this->faker->userName,
            'mobile' => '09117420258',
            'password' => bcrypt('!!AAaa22'),
        ]);
        $this->post(route('login'), [
            'username' => $user->mobile,
            'password' => '!!AAaa22'
        ]);

        $this->assertAuthenticated();
    }
}
