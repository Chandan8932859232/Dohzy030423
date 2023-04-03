<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ReferralCodeBelongsToUser implements Rule
{
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
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
       
        $userId=(new \App\Models\User)->getUserId();
        $referralCodeAttributedToUser = DB::table('users_loan_metrics')->where('user_id', $userId)->value('referral_code');
         
        //if referral code attributed to user is NOT equal to referral code being used (received from form)
        if($referralCodeAttributedToUser != $value){
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
        return __('the referral code used is not assigned to you');
    }
}
