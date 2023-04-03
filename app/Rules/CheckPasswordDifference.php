<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPasswordDifference implements Rule
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
        //** IMPORTANT: MAKE SURE YOU USE THIS RULE ONLY AFTER YOU CHECK THAT CURRENT PASSWORD EXIST */

        //Current password and new password are same
        return !strcmp(auth()->user()->password, $value)==0;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('new password can not be the same as current password');
    }
}
