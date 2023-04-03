<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReferralCodeFormat implements Rule
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
        return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[-]).{6,15}$/", $value);

        /*
        must be a minimum of 5 characters in length. Also set a maximum of 15 characters
        must include an upper case and a lower case letter.
        must include a number.
        must include a symbol.
        */
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       // return 'The :attribute must have a minimum of 5 characters, maximum of 10 characters, include a number, a symbol(-), a lower and a upper case letter';
       return __('referral code format not correct');
    }
}
