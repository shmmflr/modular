<?php

namespace Shofo\User\Tests\Unit;


use PHPUnit\Framework\TestCase;
use Shofo\User\Rules\ValidaPassword;

class PasswordValidationTest extends TestCase
{

    /**
     * @return void
     */
    public function test_password_should_include_digit_character()
    {
        $result = (new ValidaPassword())->passes('', '!!AAzz');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_password_should_include_Uppercase_character()
    {
        $result = (new ValidaPassword())->passes('', '!!00zz');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_password_should_include_Lowercase_character()
    {
        $result = (new ValidaPassword())->passes('', '!!00AA');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_password_should_include_character()
    {
        $result = (new ValidaPassword())->passes('', 'aa00AA');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_password_should_less_6_character()
    {
        $result = (new ValidaPassword())->passes('', '!Aa0');

        $this->assertEquals(0, $result);
    }

}
