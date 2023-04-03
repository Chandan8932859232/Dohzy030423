<?php

namespace App\Rules;

use App\Models\Referral;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckReferralCodeStatus implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $referral;

    public function __construct()
    {

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

        $referralCodeStatus = DB::table('individual_referral_codes')->where('referral_code', $value)->value('status');

        if($referralCodeStatus == 1){
            return false;
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('the referral code is already in use');
    }
}
