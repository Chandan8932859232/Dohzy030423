<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class PayBackDateValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
     public const LIMIT_AMOUNT_FOR_ONE_MONTH_PAY = 301;
     public $receiveDate;
     public $payDate;
     public $requestAmount;

    public function __construct($receiveDate, $payDate, $requestAmount)
    {
        //
        $this->receiveDate = $receiveDate;
        $this->payDate =$payDate;
        $this->requestAmount =$requestAmount;
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
          //requested loan amount
          $requestAmount = $this->requestAmount;   
  
          $moneyReceiveDate = $this->receiveDate;  

          //change string type to date type 
          $moneyReceiveDate = Carbon::createFromFormat('Y-m-d', $moneyReceiveDate);
          //add a month to money receive date
          $moneyReceiveDatePlusOneMonth = $moneyReceiveDate->addMonths(1); 
          $payBackdate = $value; //value is the paybackdate that comes from the form
          //change string type to date type 
          $payBackdate = Carbon::createFromFormat('Y-m-d', $payBackdate);
         
          //if requested amount is too small do not let user select a payback date of more than one month from request date
         if($requestAmount < PayBackDateValidate::LIMIT_AMOUNT_FOR_ONE_MONTH_PAY){

          if($payBackdate->gt($moneyReceiveDatePlusOneMonth)){
             return false;
          }

           return true;
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
        return  __('based on the amount you requested, your loan payback date should be a within a month');
    }
}
