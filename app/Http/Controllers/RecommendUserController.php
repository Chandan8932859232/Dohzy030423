<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use App\Notifications\RecommendedUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\Services\PhoneService;
use App\Services\RegisterService;
use App\Rules\PhoneNumberValidate;

class RecommendUserController extends Controller
{

   public $phoneService;
   public $registerService;



    public function __construct(PhoneService $phoneService , RegisterService $registerService){

        $this->middleware(['auth','verified']);
        $this->phoneService = $phoneService;
        $this->registerService = $registerService;

    }

    //user form display
    public function showReferralForm(){

        return view('user.recommend');
    }

      //admin form display
    public function showReferralCodeGeneratorForm()
    {
        //create data instance of post
        return view('admin.referral-code');  //show form that allows user to post
    }


    public function handleReferral(Request $request){

        //validate form data
        $this->validate($request, [
            'firstName' => 'required|string|min:2|max:20',
            'lastName'=> 'required|string|min:2|max:20',
            'email'=> 'required|email|max:40|unique:users',
            'phoneNumber'=> ['required','numeric', new PhoneNumberValidate, 'digits:10'],
            'relationship' => 'required',
            'trustLevel'=> 'required',
            'language'=> 'required'
        ]);

        Session::put('referredfirstName', $request->input('firstName'));
        Session::put('referredlastName', $request->input('lastName'));

        //generate referral code
        
        $userType = User::INDIVIDUAL_USER;  
        $referralCode = $this->registerService->generateReferralCode($userType,$request->input('firstName'),$request->input('lastName'));

        Session::put('generatedReferralCode', $referralCode);

        //insert referral info into table
        $referral = new Referral;

        $referral->firstname = $request->input('firstName');
        $referral->lastname = $request->input('lastName');
        $referral->email = $request->input('email');
        $referral->phone = $request->input('phoneNumber');
        $referral->relationship = $request->input('relationship');
        $referral->trust_level = $request->input('trustLevel');
        $referral->referral_code = $referralCode;
        $referral->referrer = Auth::user()->id;

        $referral->save();

        //send text message to admin about referral
        $userAccountId = Auth::user()->account_id; //$user['account_id'];
        $userName = Auth::user()->firstname;
        $this->phoneService->sendRecommendationMessageToAdmin(config('admin.super_admin_phone_number'), $userAccountId);
       
        $language =$request->input('language');
        if($request->input('language')=='other'){
            $language ='en';  //if language is other use english to communicate
        }

        //send text message to person that was reffered
          $this->phoneService->sendRecommendationMessageToReferredUser($request->input('phoneNumber'), $referralCode, $language, $userName);

        //inform the referred person that they have been referred
          // on-demand notification is used in this case because user is not member(user) of the site
        Notification::route('mail', $request->input('email'))->notify(new RecommendedUserNotification($request,$language ));

        return redirect()->route('user.referral')->with('success', __('thanks for the referral the person you referred will receive an email with the referral code'));

    }
  


}
