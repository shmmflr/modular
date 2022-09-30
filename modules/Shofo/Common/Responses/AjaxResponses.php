<?php

namespace Shofo\Common\Responses;

use Illuminate\Http\Response;


class AjaxResponses
{
    public static function success()
    {
        return response()->json(
            ['msg' => 'عملیات با موفقیت انجام شد'],
            Response::HTTP_OK
        );
    }
}
