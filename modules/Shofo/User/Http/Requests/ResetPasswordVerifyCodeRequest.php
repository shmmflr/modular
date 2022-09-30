<?php

namespace Shofo\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Shofo\User\Helper\VerifyCodeHelper;

class ResetPasswordVerifyCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation.php rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'verify_code' => VerifyCodeHelper::getRules(),
            'email' => ['required', 'email'],
        ];
    }
}
