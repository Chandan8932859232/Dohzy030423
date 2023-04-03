<?php

namespace App\Http\Controllers\Investor;

use App\Rules\CheckPasswordStrength;
use App\Rules\CheckReferralCodeStatus;
use App\Rules\ReferralCodeFormat;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Events\UserRegistered;
use App\Models\User;
use App\Models\Loan;

use  App\Services\RegisterService;
use  App\Services\SecurityService;

use Illuminate\Support\Str;
use Spatie\Newsletter\Newsletter;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserAccountCreatedNotification;
use App\Services\PhoneService;

class InvestorRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/account-create-success';
    public $register;
    public $mailChimp;
    public $phoneService;

    public $email;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( RegisterService $register , Newsletter $mailChimp, PhoneService $phoneService)
    {
         $this->middleware('guest');
         $this->register = $register;
         $this->mailChimp = $mailChimp;
         $this->phoneService = $phoneService;
    }


    //show register form page
    public  function showInvestorRegisterForm(){

        return view('investor.register');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            /*
            'referralCode'=>[ 'required', new ReferralCodeFormat,
                'exists:individual_referral_codes,referral_code',
                new CheckReferralCodeStatus
            ], */

            'password' => ['required',new CheckPasswordStrength,'confirmed'],
            'gender'=>'required',
            'language' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function create(array $data )
    {

        $generatedUserId = $this->register->generateUniqueUserId();
        $generatedUniqueAccountId = $this->register->generateUniqueAccountId($data['firstname'], $data['lastname']);

        //get user location were user created account based on I.P
        $userIp = Request()->getClientIp();
        $userLocationInfo = (new \App\Services\SecurityService)->getActionLocationInfo($userIp);

        //if location was gotten. break the data into a string to save it in the database
        if($userLocationInfo!="NA"){
           $userLocationData = implode(",",$userLocationInfo);
        }
        elseif($userLocationInfo=="NA"){ //user location was not gotten so use NA
            $userLocationData = $userLocationInfo;
        }

        //$userProvidedReferralCode = $data['referralCode'];

        $userType = User::INDIVIDUAL_USER;
        /*
        if(substr($data['referralCode'],0 ,1) === 'A'){
            $userType = User::AFRICA_USER;
        } */

        //store registration email for future use, to be used for registration confirmation page
        Session::put('registerEmail', $data['email']);

       // dd($data['gender']);

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
             'language' => $data['language'],
            'password' => Hash::make($data['password']),
            'user_role' => 4,
            'id' => $generatedUserId, //$this->register->generateUniqueUserId(),
            'account_id' => $generatedUniqueAccountId, //$this->register->generateUniqueAccountId($data['firstname'],$data['lastname']),
            'user_type' => $userType,
            'gender' => $data['gender'],
           'account_creation_ip' => $userIp,
           'account_creation_location' =>$userLocationData

        ]);

        /** TODO: normaly, laravel is able to send a notification to the user for them to verify their email without
         * the code below. so in the nearest future the code below show be removed and the system should be debugged
         *  and the developer should see to it verification emails are being sent without the code below
         **/
        //sends email verification message to  newly created user
        // $user->sendEmailVerificationNotification();

        // call event to send welcome email
        event(new UserRegistered($user));

       if (App::environment(['prod', 'production'])) {

        //prepare and name tags
            //if gender is m use Male tag else use Female tag
            $data['gender']=='m' ? $gender = "Male" : $gender = "Female";
            //if language is en tag with english else use french
            $data['language']=='en' ? $language ='English' : $language ='French';


            //subscribe user to mailChimp newsletter audience
            if (!$this->mailChimp->isSubscribed($data['email'])) {

                $this->mailChimp->subscribe($data['email'], ['FNAME' => $data['firstname'], 'LNAME' => $data['lastname']]);
                $this->mailChimp->addTags([ $generatedUniqueAccountId, 'Borrowers', $gender, $language ], $data['email'] );
            }
        }


        //insert initial loan level for user (possible amounts user can borrow)
        if($data['gender']=='f'){
          $initialLoanLevel = User::FEMALE_INITIAL_LOAN_LEVEL;
        }
        else{
          $initialLoanLevel = User::GENERAL_INITIAL_LOAN_LEVEL;
        }

        $this->register->insertInitialLoanLevel($generatedUserId, $initialLoanLevel);

        //add user to loans waiting list
        (new \App\Services\LoanService)->addUserToLoansWaitingList($generatedUserId, Loan::PERSONAL_LOAN);

        if (App::environment(['prod', 'production','beta'])) {
        //send notifications to admins that new user has been created
          //send email to super admin informing them of new account
          Notification::route('mail', config('admin.super_admin_email'))
             ->notify(new UserAccountCreatedNotification($generatedUniqueAccountId));
         /*
         //send email to admin informing them of new account
         Notification::route('mail', config('admin.admin_email'))
           ->notify(new UserAccountCreatedNotification($generatedUniqueAccountId));
          */

          //send text message to super admin informing them of money sent
            $this->phoneService->sendNewUserAccountCreatedMessageToAdmin(config('admin.super_admin_phone_number'),$generatedUniqueAccountId);
          //send text message to admin informing them of money sent
            //$this->phoneService->sendNewUserAccountCreatedMessageToAdmin(config('admin.admin_phone_number'),$generatedUniqueAccountId);
        }


        /*
        //add referral code (assign referral code to user)
        if(isset($userProvidedReferralCode)) {
            $this->register->addReferralCode($generatedUserId, $userProvidedReferralCode);
         }

        //change referral code status from default of 0 to 1 (unassigned to assigned)
        if(isset($userProvidedReferralCode)) {
            $this->register->changeReferralCodeStatus($userProvidedReferralCode, 1);
        } */


               //print success message
            Session::flash('Congratulations!!', 'Your account has been sucessfully created');
         /*
        return redirect()->route('user.register')
                         ->with('success',  'Your Account has been created. Please go to your email and verify
                                 your email');*/

           return $user;

    }

    public function accountCreateSuccess(Request $request){

        return view('user.create-user-account-complete')->with('userEmail', Session::get('registerEmail'));

    }

    /**
     * **********************************
     * Note: this overrides the register method from laravel core(vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php)
     * by so doing, we can disable auto-login after registration without making any changes to laravel core.
     * this  is achieved by omitting this line of code : $this->guard()->login($user); from this register function which
     * present in the core. it is that line that automatically logs in a user after registration
     * **********************************
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);  //comment this out to prevent auto login after registration

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


}
