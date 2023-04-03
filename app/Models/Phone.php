<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Phone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'user_id',
        'phone_type',
        'verification_status',
        'phone_number',
        'country_code',
        'verification_code'
    ];

    //primary key
    protected $primaryKey ='id'; //could be changed here

   public function getUserPhoneNumber($userId){
     $userPhoneNumber = DB::table('phones')->where('user_id', $userId)->value('phone_number');

    return $userPhoneNumber;
    
   }

   public  function getUserPhoneVerificationCode($userId){

       $userPhoneVerificationCode = DB::table('phones')->where('user_id', $userId)->value('verification_code');

       return $userPhoneVerificationCode;
   }

   public function isUserPhoneNumberProvided(){
       if(''){
           return true;
       }
        return false;
   }

    public function phoneNumberVerificationStatus($userId){

        $phoneVerified = Phone::where('user_id', $userId)->value('verification_status');
        if($phoneVerified === 1){
            return true;
        }
        return false;
    }


}
