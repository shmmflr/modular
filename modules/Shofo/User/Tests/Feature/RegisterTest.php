<?php

namespace Shofo\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Shofo\User\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_register_form()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_register_form()
    {
        $response = $this->post(route('register'), [
            'name' => 'shoeib',
            'username' => 'shofo2020',
            'email' => 'shoeib88@gmail.com',
            'mobile' => '09117420258',
            'password' => '!!AAaa22',
            'password_confirmation' => '!!AAaa22',
        ]);

//        $response->assertRedirect(route('index'));

        $this->assertCount(1, User::all());
    }

    /**
     * @return void
     */
    public function test_redirect_verify_email()
    {
        $this->post(route('register'), [
            'name' => 'shoeib',
            'username' => 'shofo2020',
            'email' => 'shoeib88@gmail.com',
            'mobile' => '09117420258',
            'password' => '!!AAaa22',
            'password_confirmation' => '!!AAaa22',
        ]);
        $response = $this->get(route('index'));
        $response->assertRedirect(route('verification.notice'));
    }

    /**
     * @return void
     */
//    public function test_redirect_after_verify()
//    {
//        $this->post(route('register'), [
//            'name' => 'shoeib',
//            'username' => 'shofo2020',
//            'email' => 'shoeib88@gmail.com',
//            'mobile' => '09117420258',
//            'password' => '!!AAaa22',
//            'password_confirmation' => '!!AAaa22',
//        ]);
//
//        $this->assertAuthenticated();
//
////        auth()->user()->markEmailAsVerified();
//        $response = $this->get(route('index'));
//        $response->assertOk();
//    }
}
