<?php

namespace Shofo\User\Helper;

class VerifyCodeHelper
{
    private static int $min = 100000;
    private static int $max = 999999;
    private static string $prifix = 'verify_code_';

    public static function generateCode()
    {
        return random_int(self::$min, self::$max);
    }

    public static function storeCache($id, $code, $time)
    {
        return cache()->set(
            self::$prifix . $id,
            $code,
            $time);
    }

    public static function getCache($id)
    {
        return cache()->get(self::$prifix . $id);
    }

    public static function deleteCache($id): bool
    {
        return cache()->delete(self::$prifix . $id);
    }

    public static function getRules()
    {
        return ['required', 'numeric', 'between:' . self::$min . ',' . self::$max];
    }

    public static function check($id, $code)
    {
        if (self::getCache($id) != $code) {
            return false;
        }
        self::deleteCache($id);
        return true;
    }

    public static function hasCode($id)
    {
        return cache()->has(self::$prifix . $id);
    }

}
