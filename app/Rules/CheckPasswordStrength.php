<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPasswordStrength implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@()$%^&*=_{}[\]:;\"'|\\<>,.\/~`±§+-]).{6,30}$/", $value);

        /*
        The password must be a minimum of 6 characters in length. Also set a maximum of 30 characters to ensure compatibility with bcrypt.
        The password must include an upper case and a lower case letter.
        The password must include a number.
        The password must include a symbol.
        */
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('the password must be 6-30 characters');
    }
}
