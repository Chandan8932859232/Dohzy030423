<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail , HasLocalePreference
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public const GENERAL_INITIAL_LOAN_LEVEL = 1;
    public const FEMALE_INITIAL_LOAN_LEVEL = 1;


    //user types
    public const INDIVIDUAL_USER = 1;
    public const GROUP_MEMBER_USER = 2;
    public const AFRICA_USER = 3;
    public const BUSINESS_USER = 4;

    //dohzy servcices
    public const LOANS_SERVICE = 1;
    public const TONTINE_SERVICE = 2;
    public const MONEY_TRANSFER_SERVICE = 3;


    public  $incrementing  = false;

    protected $fillable = [
        'id',
        'account_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'user_role',
        'language',
        'gender',
        'user_type',
        'country_of_origin',
        'identity_doc_upload_status',
        'bank_info_provided_status',
        'account_creation_ip',
        'account_creation_location',
        'work_industry',
        'years_in_canada',
        'marital_status'

    ];

    //table name
    protected $table ='users';  //could be changed here

     //primary key
     protected $primaryKey ='id'; //could be changed here



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function  getFullNameAttribute(){
        return $this->attributes['firstname'].''.$this->attributes['lastname'];
    }

    public function  getFirstName(){
        if (Auth::check()) {
            return Auth::user()->firstname;
        }
    }

    public function  getLastName(){
        if (Auth::check()) {
            return Auth::user()->lastname;
        }
    }

    public function getUserId(){
        if (Auth::check()) {
             return Auth::user()->getAuthIdentifier();
        }
    }

    public function getUserEmail(){
        if (Auth::check()) {
            return Auth::user()->email;
        }
    }


    public  function  isUserProfileComplete(){
        if (Auth::check()) {
            return Auth::user()->profile_complete_status;
        }
    }


    public function isMvpUser($userId){

        $mvpUsers = $this->getMvpUsers();
        if(in_array($userId, $mvpUsers)){
            return true;
        }
            return false;
    }

    public function getMvpUsers(){

        return [ '1023357325601e0fea1f048', '104172243960178a67d810a', '1880817562601e1a9c3c707', '5249743095601798cfc6be3',
            '5625622388601e22da0d2a3', '5883757813601e02c0afe1a', '613618577260178fb276307', '7271337059601793e0ee099',
            '7429407666601e1cec08694', '7993244038601e152dbd0e7', '848850213060177f663a86e','1787063bn9601e1a9c3c797'];

    }

    public function getUserType(){
        return Auth::user()->user_type;
    }


    public function getUserScore(){
        $userId = $this->getUserId();
        return LoanMetric::where('user_id', $userId)->value('rank');

    }

    public function getUserLanguage(){
        return Auth::user()->language;
    }

    public function getUserAccountId(){
        return Auth::user()->account_id;
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
      return $this->language;
     }


     public function userIsTontineMember(){

        $userServices = Auth::user()->services;

        $userServices = explode("," , $userServices);

        if(in_array(user::TONTINE_SERVICE, $userServices)){

            return true;
        }

            return false;


     }

     public function  userHasWallet($userId): bool
     {

         $walletInfo = DB::table('wallets')->where('user_id', '=', $userId)->get();

         if($walletInfo->count()){
             return true;
         }
         return false;
     }



     public  function  isUserOnLoansWaitingList($userId){

       $waitInfo = DB::table('loans_waiting_list')->where('user_id', '=', $userId)->get();

       $waitStatus = DB::table('loans_waiting_list')->where('user_id', '=', $userId)->value('wait_status');

       if($waitInfo->count() && $waitStatus==1){
            return true;
        }
        return false;
    }


    public function userProvidedPayStub($userId): bool
    {

        $payStub = DB::table('pay_stubs')->where('user_id', '=', $userId)->get();

        if($payStub->count()){
            return true;
        }
        return false;
    }


    public function isPayStubExceptionUser($userId){

        $payExemptUsers = $this->getPayStubExceptionUsers();
        if(in_array($userId, $payExemptUsers)){
            return true;
        }
            return false;
    }

    public function getPayStubExceptionUsers(){

        return [ '6315219666626bc76c74372', '5249743095601798cfc6be3', '5883757813601e02c0afe1a', '7271337059601793e0ee099', '31070456916244ffbb7f665', '1023357325601e0fea1f048', '38928092476268054039bf6'];

    }


}
