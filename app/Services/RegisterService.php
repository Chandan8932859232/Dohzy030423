<?php
namespace App\Services;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterService {

  public function generateUniqueUserId() : String
  {

  $userId = mt_rand(1000000000, 9999999999).uniqid();

  if($this->userIdExists($userId)){

    return $this->generateUniqueUserId(); //if userIdExist call generateUniqueUserId again
  }

  return $userId;

  }


  public function userIdExists($userId)
  {
    return  User::where('id',$userId)->first();
  }


  public function generateUniqueAccountId($firstname ,$lastname){

      $accountId = substr(strtoupper($firstname),0,2).substr(strtoupper($lastname), 0,2).mt_rand(100, 900);

      if($this->userAccountIdExist($accountId)){

          return $this->generateUniqueAccountId($firstname ,$lastname); //if Exist call generate again
      }

      return $accountId;
  }


  public function userAccountIdExist($accountId)
    {
        return  User::where('account_id',$accountId)->first();
    }

    public function insertInitialLoanLevel($userId,$loanLevel){

        DB::table('users_loan_metrics')->updateOrInsert(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
                'loan_level' => $loanLevel,
            ]);
    }

    public function addReferralCode($userId,$referralCode){

        DB::table('users_loan_metrics')->updateOrInsert(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
                'referral_code' => $referralCode,
            ]);
    }

    public function changeReferralCodeStatus($referralCode,$status){

        DB::table('individual_referral_codes')
            ->where('referral_code', $referralCode)
            ->update(['status' => $status]);
    }


    public  function completeUserRegistration($userId){

        User::where('id', $userId)
            ->update(['profile_complete_status' => 1]);

    }


    public function generateReferralCode($userType, $userFirstName, $userLastName) : string {

        switch ($userType) {

            case User::INDIVIDUAL_USER:
                $referralCode ='I'.strtoupper(substr($userFirstName,0,1)).strtoupper(substr($userLastName ,0,1)).'-'.chr(rand(97,122)).substr(uniqid(),0,2).mt_rand(10, 80);
                if($this->referralCodeExists($referralCode)){
                    return $this->generateReferralCode($userType, $userFirstName, $userLastName); //if referralCodeExists call generateReferralCode again(recursive)
                }
                return $referralCode;
                break;

            case User::BUSINESS_USER:
                 $referralCode ='B'.strtoupper(substr($userFirstName,0,1)).strtoupper(substr($userLastName ,0,1)).'-'.chr(rand(97,122)).substr(uniqid(),0,2).mt_rand(10, 80);
                 if($this->referralCodeExists($referralCode)){
                      return $this->generateReferralCode($userType, $userFirstName, $userLastName); //if referralCodeExists call generateReferralCode again(recursive)
                 }
                return $referralCode;
                break;

            case User::GROUP_MEMBER_USER :
                $referralCode ='G'.strtoupper(substr($userFirstName,0,1)).strtoupper(substr($userLastName ,0,1)).'-'.chr(rand(97,122)).substr(uniqid(),0,2).mt_rand(10, 80);
                if($this->referralCodeExists($referralCode)){
                    return $this->generateReferralCode($userType, $userFirstName, $userLastName); //if referralCodeExists call generateReferralCode again(recursive)
                }
                return $referralCode;
                break;

            case User::AFRICA_USER :
                $referralCode ='A'.strtoupper(substr($userFirstName,0,1)).strtoupper(substr($userLastName ,0,1)).'-'.chr(rand(97,122)).substr(uniqid(),0,2).mt_rand(10, 80);
                if($this->referralCodeExists($referralCode)){
                    return $this->generateReferralCode($userType, $userFirstName, $userLastName); //if referralCodeExists call generateReferralCode again(recursive)
                }
                return $referralCode;
                break;

            default :
                $referralCode ='XX'.strtoupper(substr($userFirstName,0,1)).strtoupper(substr($userLastName ,0,1)).'-'.chr(rand(97,122)).substr(uniqid(),0,2).mt_rand(10, 80);
                if($this->referralCodeExists($referralCode)){
                    return $this->generateReferralCode($userType, $userFirstName, $userLastName); //if referralCodeExists call generateReferralCode again(recursive)
                }
                return $referralCode;
        }

    }

    public function referralCodeExists($referralCode)
    {
        return  Referral::where('referral_code',$referralCode)->first();
    }



}
