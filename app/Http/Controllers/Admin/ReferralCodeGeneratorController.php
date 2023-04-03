<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendReferredPersonReferralInfo;
use App\Notifications\SendReferrerReferralInfo;
use App\Rules\CheckReferralCodeStatus;
use App\Rules\ReferralCodeFormat;
use App\Services\RegisterService;
use Illuminate\Http\Request;

use App\Models\Referral;
use App\Notifications\ApplicationProcessedNotification;
use Illuminate\Support\Facades\Notification;

class ReferralCodeGeneratorController extends Controller
{

    public $registerService;

    public function __construct(RegisterService $registerService){

        $this->middleware('auth:admin');
        $this->registerService = $registerService;

    }

    public function showReferralCodeGeneratorForm()
    {
        //create data instance of post
        return view('admin.referral-code'); // show form that allows user to post

    }

    public function saveReferralInfo(Request $request){
        //
        $request->validate([
        'firstName'=>'required|min:1|max:20',
        'lastName'=>'required|min:1|max:20',
        'email'=>'required|string|email',
        'phone'=>'required|numeric',
        'relationship'=>'required',
        'trustLevel'=>'required',
        'referrer' =>'required',
        'userType' =>'required'

       ]);

       $referralCode = $this->registerService->generateReferralCode($request->input('userType'),
                                                                    $request->input('firstName'),
                                                                    $request->input('lastName'));

        $referral = new Referral;

       $referral->firstName = $request->input('firstName');
       $referral->lastName  = $request->input('lastName');
       $referral->email = $request->input('email');
       $referral->phone =  $request->input('phone');
       $referral->relationship = $request->input('relationship');
       $referral->trust_level = $request->input('trustLevel');
       $referral->referral_code = $referralCode;
       $referral->referrer = $request->input('referrer');

       $referral->save(); //save info in database

        /*
        $user= User::first(); //
        Notification::send($user, new SendReferredPersonReferralInfo());
        $user->notify(new  SendReferrerReferralInfo());
        */

       return redirect()->route('assign.referral-code-form')->with('success', 'The referral code is: '.$referralCode.' the next step will be to assign referral code to user');

    }

    public function showAssignReferralCodeForm(){

        return view('admin.assign-code-to-user');
    }

    public function  assignReferralCodeToUser(Request $request){

        $request->validate([
            'referralCode'=>['required', new ReferralCodeFormat,
                'exists:individual_referral_codes,referral_code',
                new CheckReferralCodeStatus
                ],
            'userId'=>'required|min:1|max:40',
        ]);

        // assign the referral code to the user
        $this->registerService->addReferralCode($request->input('userId'),$request->input('referralCode'));

        //change referral code status from default of 0 to 1 (unassigned to assigned)
        $this->registerService->changeReferralCodeStatus($request->input('referralCode'), 1);

        return redirect()->route('assign.referral-code-form')->with('success', 'The referral code has been assigned and status changed');

    }




}
