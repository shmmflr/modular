<?php

namespace Shofo\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaMobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation.php rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^09[0-9]{9}$/', $value);
    }
    /**
     * Get the validation.php error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فرمت وارد شده موبایل شما صحیح نمی باشد';
    }
}
