<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DatesCompare implements Rule
{

    public $firstDate;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($firstDate)
    {
        //
        $this->firstDate = $firstDate;
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
        //

        $secondDate = $value;
        $firstDate = $this->firstDate;

        //change string type to date type 
        $firstDate = Carbon::createFromFormat('Y-m-d', $firstDate);

        $secondDate = Carbon::createFromFormat('Y-m-d', $secondDate);


        if($secondDate->gt($firstDate)){
           
            return true;        
        }

       /* 
        if($secondDate->eq($firstDate)){   
            return true;
        } */

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('second installment payback date should be after first installment payback date');
    }
}
