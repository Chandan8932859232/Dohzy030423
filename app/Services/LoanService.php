<?php
namespace App\Services;

use App\Models\Loan;
use App\Models\LoanRepay;
use App\Repositories\LoanRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoanService{

    private  $loanRepository;
 /*
    public function __construct( LoanRepository $loanRepository{

         $this->loanRepository = $loanRepository;
    }
    */

    public function generateApplicationId(){

        $fundsApplicationId = "LOAN".substr(md5(uniqid()),0,4).mt_rand(100, 800);

        if($this->fundsApplicationIdExist($fundsApplicationId)){

            return $this->generateApplicationId(); //if Exist call generate again
        }

        return  $fundsApplicationId;
    }

    public function fundsApplicationIdExist($fundsApplicationId)
    {
        return  Loan::where('id',$fundsApplicationId)->first();
    }


    public function generatePaymentId(){

        $paymentId = "PAY".substr(md5(uniqid()),0,5).mt_rand(100, 900);

        if($this->paymentIdExist($paymentId)){

            return $this->generatePaymentId(); //if Exist call generate again
        }

        return  $paymentId;
    }

    public function paymentIdExist($paymentId)
    {
        return  LoanRepay::where('payment_id',$paymentId)->first();
    }

    /** check if application isGroupMemberApplication (applicant is applying through group)
     * @params:applicationId
     * return bool
     */
    public function isGroupMemberApplication($applicationId){

        $applicationType = $this->applicationRepository->getApplicationType($applicationId);
         return $applicationType === Loan::GROUP_MEMBER_APPLICATION;
    }

    /**check if application isNoneGroupMemberApplication (applicant is not applying through group)
     * @params:applicationId
     * return bool
     */
    public function isReferredApplication($applicationId){

       $applicationType = $this->applicationRepository->getApplicationType($applicationId);
         return $applicationType === Loan::PERSONAL_LOAN;
    }

    // get user loan range
    public function getLoanRange($userId){

        $loanRange = array(); //array to hold loan range

        $possibleLoanAmounts = $this->getPossibleLoanAmounts($userId);
        $lowerRange = $possibleLoanAmounts[0]; //get first element in array of possible amounts; used for range lower bound
        $upperRange  = array_pop($possibleLoanAmounts); //get last element in array
        array_push($loanRange,$lowerRange,$upperRange); //push upper range and lower range to array

         return $loanRange;

    }

    Public function getPossibleLoanAmounts($userId)
    {
         $loanLevel = $this->getLoanLevel($userId);

         $loanAmounts = DB::table('loan_levels')->where('loan_level', $loanLevel)->value('amounts');

           $loanAmounts = explode(',', $loanAmounts); //convert string to that was gotten from database to array

           return $loanAmounts;
    }


    public function getLoanLevel($userId){

        $fallBackLoanLevel = 3; //loan level to be used if query to get actual loan level fails

        $loanLevel = DB::table('users_loan_metrics')->where('user_id', $userId)->value('loan_level');
        if(is_null($loanLevel)){
            return $fallBackLoanLevel;
        }
        return $loanLevel;
    }


    Public function getRealEstateAssistLoanAmounts($userId)
    {

        return $realEstateLoanAmounts = [ 2000, 2500, 3000, 3500, 4000, 4500, 5000 ];

    }


    /*
     * check if referral code is for a group
     * @params: $referralCode
     * return : true or false
     */
    public function isReferralCodePresent($referralCode)
    {

       if(Str::startsWith($referralCode, 'G')){
           //search for group referral code
            $result = DB::table('groups')->where('referral_code', $referralCode);

           if(is_null($result)){
               return false;
           }
           return true;
       }

        if(Str::startsWith($referralCode, 'I')){
            //search for individual referral code
            $result = DB::table('individual_referral_codes')->where('referral_code', $referralCode);

            if(is_null($result)){
                return false;
            }
            return true;
        }

    }

    //get user assigned referral code
    public function getUserReferralCode($userId){

       return  DB::table('users_loan_metrics')->where('user_id', $userId)->value('referral_code');

    }



    public function getWaitPeriodBetweenLoans($userId){

       return  DB::table('users_loan_metrics')->where('user_id', $userId)->value('time_between_loans');

    }


    /* Change funds application status
     * function will change/update the status of an application
     * @params: $applicationId , $newApplicationStatus
     * $applicationId : unique identification for particular application
     * $applicationStatus : status to change to (target status)
     *
     */
    public function changeApplicationStatus($applicationId, $newApplicationStatus){
     /** todo:log or add some indication when query fails */
        DB::table('loans')->where('id', $applicationId)
                                       ->update(['application_status'=> $newApplicationStatus]);

    }

 // Interest rate for a particular user (base line interest rate)
    public function getUserInterestRate($userId)
    {
        return DB::table('users_loan_metrics')->where('user_id', $userId)->value('interest_rate');
    }

    //calculates the specific interest rate on loan based on parameters like amount burrowed, duration, payment scheme
    public function calculateSpecificLoanInterestRate($userId, $amountBurrowed, $payBackDate, $numberOfInstallments){

         $userBaseLineInterestRate = $this->getUserInterestRate($userId);   //get baseline interest rate

         $specificLoanInterestRate = $userBaseLineInterestRate;  //initialize baseline interest rate to be the same as specific loan interest rate

         if($amountBurrowed > 499 && $amountBurrowed < 701 ){
            $specificLoanInterestRate = $specificLoanInterestRate + 2;
         }

         if($amountBurrowed > 701 && $amountBurrowed < 1001){
            $specificLoanInterestRate = $specificLoanInterestRate + 2.5;
         }

         if($numberOfInstallments == 2){
            $specificLoanInterestRate = $specificLoanInterestRate + 1.5;
         }

         if($numberOfInstallments == 3){
            $specificLoanInterestRate = $specificLoanInterestRate + 2.5;
         }

         $payBackDate = session('payBackDate');

         $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

         $currentDatePlusFourteenDays = $currentDate->addDays(14);  // 2 weeks from today

         $currentDatePlusThirtyFiveDays = $currentDate->addDays(35);  // 5 weeks from today

         $currentDatePlusTwentyOneDays = $currentDate->addDays(21);  // 3 weeks from today


        switch ($numberOfInstallments) {

          case 1 :  //one payback date
          //evaluate how far the dates are in the future and increase interest based on that
          $refundDate = Carbon::createFromFormat('Y-m-d', $payBackDate['onlyPayBackDate']);

          if($refundDate->gt($currentDatePlusTwentyOneDays)){

            $specificLoanInterestRate = $specificLoanInterestRate + 0.3;
            //dd($specificLoanInterestRate);
          }
          break;

          case 2: //two payback dates (user paying back in 2 installments)
           // if firstPaybackDate > 2weeks from now +0.3 to interest rate
           // if secondPaybackDate > 5weeks from now +0.3 to interest rate

           $firstPayBackDate = Carbon::createFromFormat('Y-m-d', $payBackDate['firstPayDate']);

           $secondPayBackDate = Carbon::createFromFormat('Y-m-d', $payBackDate['secondPayDate']);

           if($firstPayBackDate->gt($currentDatePlusFourteenDays)){

               $specificLoanInterestRate = $specificLoanInterestRate + 0.3;
            }

           if($secondPayBackDate->gt($currentDatePlusThirtyFiveDays)){

              $specificLoanInterestRate = $specificLoanInterestRate + 0.3;
           }

          break;


          case 3: //three payback dates

          break;

          default:

        }

        return $specificLoanInterestRate;

    }

    //Interest rate for a particular loan transaction
    public function getSpecificLoanInterestRate($loanId){
        return DB::table('loans')->where('id', $loanId)->value('interest_rate');
    }



//calculates payback amount for a particular loan
    public function loanPayBackAmount($loanId,$amountBurrowed)
    {

      return round( $amountBurrowed + $this->loanInterestAmount($loanId, $amountBurrowed), 2);

    }

     //initial amount to be paid back. first payback amount at the point of application
     public function initialLoanPaybackAmount($amountBurrowed, $loanInterestRate){

       return  round ( $amountBurrowed + ($amountBurrowed * $loanInterestRate/100), 2);

     }


    public function repayInInstallmentsStatus($loanId){

      $installmentState =  DB::table('loans')->where('id', $loanId)->value('installment_payback_status');

      if( $installmentState == 1 ){

        return true;
      }
        return false;

    }


    public function getPayBackDates($loanId){

        return DB::table('loans_installment_refund')->where('loan_id', $loanId)->value('payback_dates');

    }

    public function getPayInstallmentAmounts($loanId){

        return DB::table('loans_installment_refund')->where('loan_id', $loanId)->value('amount_per_installment');

    }

    public function getNumberOfInstallments($loanId){

        return DB::table('loans_installment_refund')->where('loan_id', $loanId)->value('number_of_installments');

    }





    public function calculateAmountPerInstallmentForTwoInstallments($payBackAmount, $numberOfInstallments){

        return $payBackAmount/$numberOfInstallments;
    }

    public function loanInterestAmount($loanId, $amountBurrowed)
    {
       $loanInterestRate =  $this->getSpecificLoanInterestRate($loanId);

        return $amountBurrowed * ($loanInterestRate/100);
    }

    public function initialLoanBalance($userId,$amountBurrowed, $loanId){
        //get userId
       // $userId = DB::table('loans')->where('id', $loanId)->value('applicant_user_id');
        //$amountBurrowed = DB::table('loans')->where('id', $loanId)->value('application_amount');
        $initialLoanPayBackAmount = $this->initialLoanPaybackAmount($userId,$amountBurrowed);
        $loanCharges = $this->getAllChargesForALoan($loanId);
        return $initialLoanPayBackAmount +  $loanCharges;

    }

    public function updateLoanBalanceAfterCharge($loanId, $chargeAmount){

        $currentLoanBalance = (new \App\Models\Loan)->getLoanBalance($loanId);

        $newLoanBalance =  $currentLoanBalance + $chargeAmount;

        //update balance
        DB::table('loans')->where('id', $loanId)->update(['balance' => $newLoanBalance]);

        return $newLoanBalance;

    }

    public function singleLoanBalance($loanId){
        //get userId
         $userId = DB::table('loans')->where('id', $loanId)->value('applicant_user_id');
         $amountBurrowed = DB::table('loans')->where('id', $loanId)->value('application_amount');
         $initialLoanPayBackAmount = $this->initialLoanPaybackAmount($userId,$amountBurrowed);
         $loanCharges = $this->getAllChargesForALoan($loanId);
        return $initialLoanPayBackAmount +  $loanCharges;

    }


    public function processLoanRepayment($loanId, $paymentAmount, $paymentDate, $paymentMethod){

        //generate paymentId
        $paymentId = $this->generatePaymentId();

        //get userId of loan applicant
        $userId = DB::table('loans')->where('id', $loanId)->value('applicant_user_id');

        //get loan balance
        $loanAmount = DB::table('loans')->where('id', $loanId)->value('application_amount');

        //get current loan state
        $currentLoanState = DB::table('loans')->where('id', $loanId)->value('application_status');


        //check if loan exist in loan_repay table, if loan does not exist, this will be used to change loan state in the loans table
        $targetLoan = LoanRepay::where('loan_id','=',$loanId)->first();

        $repayLoan = new LoanRepay;

        $newLoanBalance = $this->updateLoanBalanceAfterPayment($loanId, $paymentAmount);

        //store payment information in table
          $repayLoan->payment_id = $paymentId;
          $repayLoan->user_id = $userId;
          $repayLoan->loan_id = $loanId;
          $repayLoan->payment_date =  $paymentDate;
          $repayLoan->payment_method = $paymentMethod;
          $repayLoan->amount_paid = $paymentAmount;
          $repayLoan->loan_amount =  $loanAmount;  //to be removed from table
          $repayLoan->balance =  $newLoanBalance;  //to be removed, keep only one copy of balance //$loanBalance;

          $repayLoan->save();

          //** update Loan State After Payment **/
          //loan did not exist in loans repay table before(ie this is first repayment). so change loan state to loan is currently bieng paid
          if($targetLoan == null or empty($targetLoan)) {

              if($currentLoanState != Loan::LOAN_REPAYMENT_IS_ONGOING){

                //Change loan status to loan repayment is ongoing
                 DB::table('loans')->where('id', $loanId)->update(['application_status' => Loan::LOAN_REPAYMENT_IS_ONGOING]);

             }
          }

    }

    public function updateLoanStateAfterRepayment($loanId){

        $loanBalance = (new \App\Models\Loan)->getLoanBalance($loanId);

        if($loanBalance ==0 || $loanBalance <0 ) {
            //change loan state to completely repaid
            DB::table('loans')->where('id', $loanId)->update(['application_status' => Loan::LOAN_COMPLETELY_REPAID]);
        }

    }


    public function updateLoanBalanceAfterPayment($loanId, $paymentAmount){

       $currentLoanBalance = (new \App\Models\Loan)->getLoanBalance($loanId);
       $newLoanBalance =  $currentLoanBalance - $paymentAmount;

       //update balance
       DB::table('loans')->where('id', $loanId)->update(['balance' => $newLoanBalance]);

       return $newLoanBalance;

    }


    public function changeUserLoanLimit($userId, $newLoanLevel){

      $queryStatus;

      try{
        DB::table('users_loan_metrics')->where('user_id', $userId)->update(['loan_level'=> $newLoanLevel]);
        $queryStatus = "Successful";
        }
       catch(Exception $e){
        $queryStatus = "error in changing loan level";

      }

    }


    public function changeUserType($userId, $newUserType){

        $queryStatus;

        try{
          DB::table('users')->where('id', $userId)->update(['user_type'=> $newUserType]);
          $queryStatus = "Successful";
          }
        catch(Exception $e){
          $queryStatus = "error in changing loan level";

        }

      }




    public function getApplicationStatus($status){
        switch ($status) {

            case Loan::APPLICATION_NOT_RECEIVED:
                return __('not received');
            break;

            case Loan::APPLICATION_RECEIVED:
                return __('request received to be processed');
            break;

            case Loan::APPLICATION_IS_PROCESSING:
                return __('in process');
            break;

            case Loan::APPLICATION_AWAITING_USER_APPROVAL:
                return __('pending user approval');
                break;

            case Loan::APPLICATION_PROCESSED_AND_REJECTED:
                return __('rejected');
                break;

            case Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT:
                return __('approved money will be sent');
                break;

            case Loan::APPLICATION_APPROVED_AND_MONEY_SENT:
                return __('approved money sent');
                break;

            case Loan::LOAN_PAYMENT_MADE_BUT_TO_BE_VERIFIED:
                return __('loan repayment made but to be verified');
                break;

            case Loan::LOAN_COMPLETELY_REPAID:
                return __('loan completely repaid');
                break;

            case Loan::LOAN_TERMS_AND_CONDITIONS_REJECTED:
                return __('loan terms rejected');
                break;

            case Loan::LOAN_REPAYMENT_IS_ONGOING:
                return __('repayment is on going');
                break;

            case Loan::LOAN_IS_WITH_INTERNAL_COLLECTIONS :
                return __('loan is with internal collections');
                break;

            case Loan::LOAN_IS_WITH_EXTERNAL_COLLECTIONS :
                return __('loan is with external collections');
                break;

            case Loan::LOAN_WAS_RECOVERED_FROM_EXTERNAL_COLLECTIONS :
                return __('loan was recovered from external collections');
                break;

            default:
                return __('unknown');
        }



    }


    public function generateSendInteracPassword()
    {
        $nameInitials = $this->getNameInitials();
        return "DohzyCollect".rand(1,50).$nameInitials;
    }

    public function generatePayBackInteracPassword()
    {
        $nameInitials = $this->getNameInitials();
        return "DohzyPay".rand(1,50).$nameInitials;
    }

    public function getNameInitials()
    {
       return substr(Auth::user()->firstname,0,1).substr(Auth::user()->lastname,0,1);
    }

    public function getAccountIdOfLoanApplicant($userId){
        return DB::table('users')->where('id', $userId)->value('account_id');
    }

    public function getNameOfLoanApplicant($userId){
        $firstname = DB::table('users')->where('id', $userId)->value('firstname');
        $lastname = DB::table('users')->where('id', $userId)->value('lastname');

        return $firstname. ' '.$lastname;
    }

    public  function  trimBankInfo($accountInfo){
       $bankInfo = substr($accountInfo,0,2);

       if(strlen($accountInfo)==5){
           $transitNumber = $bankInfo."x"."x"."x";
           return $transitNumber;
       }
       elseif(strlen($accountInfo)==7 ||strlen($accountInfo)==12 ){
           $accountNumber = $bankInfo."x"."x"."x"."x"."x";
           return $accountNumber;
       }

       return "xxxxx";

    }


    public function paymentMethodShow($method){

        switch ($method){
            case 1:
                return __('interac etransfer');
            break;

            case 2:
                return __('automatic bank withdrawal');
            break;

            case 3:
                return __('PayPal');
            break;

            default:
             return __('unknown');
        }


    }


    public function generateBankAccountId() : String
    {

    $bankAccountId = "BANKACCT".mt_rand(999, 999).substr(uniqid(),0,5);

    if($this->bankAccountIdExists($bankAccountId)){

      return $this->generateBankAccountId(); //if bankAccIDexist call generateBankAccountId again
    }

    return  $bankAccountId;

    }


    public function bankAccountIdExists($bankAccountId)
    {
      return  DB::table('bank_account_information')->where('id', $bankAccountId)->first();
    }



    public function addUserToLoansWaitingList($userId, $loanType){


        DB::table('loans_waiting_list')->updateOrInsert(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
             'loan_type' => $loanType,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s'),

            ]);

    }


// Charge related functions

  public  function  isLoanCharged($loanId){

    $loanCharges = DB::table('charges')->where('loan_id', '=', $loanId)->get();

    if($loanCharges->count()){
         return true;
     }
     return false;
 }

   public function getTotalChargesForALoan($loanId){

    $totalCharges = DB::table('charges')->where('loan_id', $loanId)->sum('amount');

    return $totalCharges;

   }

   public function getAllChargesForALoan($loanId){

    $loanCharges = DB::table('charges')->where( 'loan_id', $loanId)->get();


    return $loanCharges;


   }

   public function addChargeToLoan($loanId, $chargeAmount, $type){

       DB::table('charges')->insert(
         [
            'loan_id' => $loanId,
            'amount' => $chargeAmount,
            'charge_type' => $type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
         ]);


     //update loan balance after you add charge
     $this->updateLoanBalanceAfterCharge($loanId, $chargeAmount);


   }



   public function chargeTypeShow($chargeType){

    switch ($chargeType){

        case 1:
            return __('non sufficient funds fee');
        break;

        case 2:
            return __('late payment fee');
        break;

        case 3:
            return __('payment postponement fee');
        break;

        case 4:
            return __('external collections fee');
        break;

        case 5:
            return __('loan default payment plan fee');
        break;

        default:
         return __('unknown');
    }


}



    /*
    showUserApplicationResult() //response shown to user right after application  [explain steps to user based on situation]
    sendRequestRecievedConfirmationEmail()
    sendAdminMessageToConfirmMember()
    getAdminMemberConfirmResponse()
    sendUserRequestResults()
    updateMoneyRequestStatus()

     //possible helper functions
      isGroupMember($userId)
      isGroupAffiliate() //do we know the group
      isMembersListProvided()  //

      generateVerificationCode() //Phone verification code

       ** Think of creating a group model **





    */


}




?>
