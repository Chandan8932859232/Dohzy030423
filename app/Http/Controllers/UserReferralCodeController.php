<?php

namespace App\Http\Controllers;

use App\Notifications\LoanRequestReceivedAdminNotification;
use App\Notifications\UserRequestReferralCodeNotification;
use App\Services\PhoneService;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Referral;

class UserReferralCodeController extends Controller
{
    //
    public $user;
    public $phoneService;
    public $registerService;


    public function __construct(PhoneService $phoneService, User $user, RegisterService $registerService){

        $this->middleware('auth');
        $this->phoneService = $phoneService;
        $this->user = $user;
        $this->registerService = $registerService;

    }

    public function showRequestCodeForm(){

        //return view('user.request-referral-code');

        return view('user.generate-user-referral-code');

    }

    public function processRequestCode(Request $request){

        $request->validate([
            'referralCodePurpose'=>'required',
        ]);

        //send message to admins that user has requested referral code

        // send notification to admin that user applied for funds
        if(App::environment(['prod', 'production', 'stage', 'beta', 'dev', 'local'])) {

            //send text message to super admin
            $userAccountId = Auth::user()->account_id;

             $this->phoneService->sendReferralCodeRequestMessageToAdmin(config('admin.super_admin_phone_number'), $userAccountId);
            //send text message to admin
             //$this->phoneService->sendReferralCodeRequestMessageToAdmin(config('admin.admin_phone_number'), $userAccountId);

            //send mail notification to admins(on-demand notification)
            Notification::route('mail', config('admin.super_admin_email'))
                ->notify(new UserRequestReferralCodeNotification());
        }

        return redirect()->route('request.referral-code')->with('success', __('your request has been received. we shall contact you shortly with a response'));

    }

    public function showUserGenerateReferralCodeForm(){

        return view('user.generate-user-referral-code');

    }


    public function createUserReferralCode(Request $request){

        $userId = $this->user->getUserId();
        
        if((new \App\Services\LoanService)->getUserReferralCode($userId)){

            return redirect()->route('user.show-generate-referral-code')->with('warning', __('you already have a referral code'));
         }

         $request->validate([
            /*
            'referralCode'=>['required', new ReferralCodeFormat,
                'exists:individual_referral_codes,referral_code',
                new CheckReferralCodeStatus
                ], */

            'referrer'=>'required|min:1|max:50',
        ]);
        
        $userType = $this->user->getUserType();
        $userFirstName = $this->user->getFirstName();
        $userLastName = $this->user->getLastName();
        $userEmail = $this->user->getUserEmail();
        $userPhoneNumber = (new \App\Models\Phone)->getUserPhoneNumber($userId);
        $relationship = 5;
        $trustLevel = 2;

        //generate referral code
        $referralCode = $this->registerService->generateReferralCode($userType, $userFirstName, $userLastName);
        
       
        //save generated referral code 

        $referral = new Referral;

        $referral->firstName = $userFirstName;
        $referral->lastName  = $userLastName;
        $referral->email = $userEmail;
        $referral->phone = $userPhoneNumber;
        $referral->relationship = $relationship;
        $referral->trust_level = $trustLevel;
        $referral->referral_code = $referralCode;
        $referral->referrer = $request->input('referrer');
 
        $referral->save(); //save info in database

        // assign the referral code to the user
        $this->registerService->addReferralCode($userId,$referralCode);

        //change referral code status from default of 0 to 1 (unassigned to assigned)
        $this->registerService->changeReferralCodeStatus($referralCode, 1);
         
        //send user back to loan application form
         return redirect()->route('funds-apply.create')->with('info', __('a referral code has been generated for you. now can apply for a loan'));

    }


}
