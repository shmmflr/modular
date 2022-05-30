<?php

namespace Shofo\User\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Shofo\User\Rules\ValidaMobile;

class MoblieValidtionTest extends TestCase
{
    /**
     * @return void
     */
    public function test_mobile_character_less_10()
    {
        /**
         * اگر کمتر از 10 کاراکتر وارد کرد خطا میده اگر 0 برگشت داد یعنی خطا میده و تست درسته
         */
        $result = (new ValidaMobile())->passes('', '091174202');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_mobile_character_more_10()
    {
        /**
         * اگر بیشتر از 10 کاراکتر وارد کرد خطا میده اگر 0 برگشت داد یعنی خطا میده و تست درسته
         */
        $result = (new ValidaMobile())->passes('', '0911742025800');

        $this->assertEquals(0, $result);
    }

    /**
     * @return void
     */
    public function test_mobile_character_start_09()
    {
        /**
         * اگربا 09 شروع نشد خطا میده اگر 0 برگشت داد یعنی خطا میده و تست درسته
         */
        $result = (new ValidaMobile())->passes('', '2211742025');

        $this->assertEquals(0, $result);
    }
}
