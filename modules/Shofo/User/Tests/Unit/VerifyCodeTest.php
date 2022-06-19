<?php

namespace Shofo\User\Tests\Unit;


use Shofo\User\Helper\VerifyCodeHelper;
use Tests\TestCase;

class VerifyCodeTest extends TestCase
{


    public function test_generate_verify_code()
    {
        $code = VerifyCodeHelper::generateCode();
        $this->assertIsNumeric($code);
        $this->assertLessThanOrEqual(999999, $code, 'less 999999');
        $this->assertGreaterThanOrEqual(100000, $code, 'less 100000');
    }

    public function test_store_code()
    {
        $code = VerifyCodeHelper::generateCode();
        VerifyCodeHelper::storeCache(1, $code);
        $this->assertEquals($code, cache()->get('verify_code_1'));
    }

}
