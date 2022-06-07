<?php

namespace Shofo\User\Helper;

class VerifyCodeHelper
{

    public static function generateCode()
    {
        return random_int(100000, 999999);
    }

    public static function storeCache($id, $code)
    {
        return cache()->set(
            'verify_code_' . $id,
            $code,
            now()->addDay());
    }

}
