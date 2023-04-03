<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanMetric;
use App\Models\User;
use App\Models\Phone;
use App\Models\Referral;
use App\Models\LoanInstallmentRefund;
use App\Notifications\ApplicationProcessedNotification;
use App\Notifications\ApplicationRecievedNotification;
use App\Notifications\LoanRequestReceivedAdminNotification;
use App\Rules\CheckReferralCodeStatus;
use App\Rules\ReferralCodeBelongsToUser;
use App\Rules\ReferralCodeFormat;
use App\Rules\PayBackDateValidate;
use App\Services\LoanService;
use App\Events\MoneyRequestRecieved;
use App\Jobs\ProcessMoneyApplication;
use App\LoanInstallmentRefund as AppLoanInstallmentRefund;
use App\Services\PhoneService;
use App\Services\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Config;
use Illuminate\Support\Facades\Session;
use App\Rules\DatesCompare;


class ApplyForFundsController extends Controller
{
    public $user;
    public $funds;
    public $phone;
    public $loanService;
    public $phoneService;




    public function __construct(User $user, Phone $phone, LoanService $funds, PhoneService $phoneService){
        $this->middleware('auth');
        $this->user = $user;
        $this->funds = $funds;
        $this->phone = $phone;
        $this->phoneService = $phoneService;

    }

    /**
     * Display form to allow user to select type of application
     * Two types of applications (group-member application and non-group member application)
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function chooseApplicationType(Request $request){

         $application = $request->session()->get('application');

         return view('funds-application.choose-type', compact('application', $application));
     }

    /**
     * loads the proper application form based on application type (group-member and non-group member)
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  directApplicationType(Request $request){

        $validatedData = $request->validate([
            'userBelongsToGroup'=>'required',
        ]);

        //$userId = $this->user->getUserId();
        //$possibleLoanAmounts = $this->funds->getPossibleLoanAmounts($userId);


        if(empty($request->session()->get('application'))) {
            $application = new Loan();
            $application->fill($validatedData);
            $request->session()->put('application', $application);
        }
        else{
            $application = $request->session()->get('application');
            $application->fill($validatedData);
            $request->session()->put('application', $application);
        }

            if($request->input('userBelongsToGroup')==='yes'){

                $request->session()->put('groupMemberApplication', $request->input('userBelongsToGroup'));

                //delete session variable for referred application if user chooses group member application
                $request->session()->forget('referredApplication');

                return  $this->create( $request); // view('funds-application.create',  compact('possibleLoanAmounts'));
            }

           $request->session()->put('referredApplication', $request->input('userBelongsToGroup'));

               //delete session variable for group member application if user chooses referred application
               $request->session()->forget('groupMemberApplication');

           return  $this->create( $request); // view('funds-application.referred-application.create',  compact('possibleLoanAmounts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function storeReferredApplication(Request $request){

        //validate info
        $request->validate([
            'referralCode'=>'required',
            'payBackDate' => 'required',
            'referralMoneyReceiveMeans' => 'required',
            'autoDepositEnabled' => 'required',
        ]);

        /*
                //validate referral code

                $application = new Loan; //create instance of application model

                $application->id = $this->funds->generateApplicationId();
                $application->application_amount = $request->input('applicationAmount');

                $application->save(); //save application to db
                */
        $request->session()->put('interacTransferMethod', $request->input('referralMoneyReceiveMeans'));

        return redirect()->route('deposit.information')->with('info', 'Please confirm your information');

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /*
    public function index()
    {
        //
        //$applications = Loan::all();
        $applications = Loan::orderBy('created_at','desc')->paginate(5);
        return view('funds-application.index', compact('applications'));
    }
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {

          $userId = $this->user->getUserId();
          $userType = $this->user->getUserType();

          $possibleLoanAmounts = $this->funds->getPossibleLoanAmounts($userId);

          //$userReferralCode =  $this->funds->getUserReferralCode($userId);

          $metrics = LoanMetric::where('user_id', $userId)->first();

          if($userType == User::AFRICA_USER){
              return  view('funds-application.africa.create');
          }
          elseif($userType == User::BUSINESS_USER){
             return view('funds-application.business.create',compact('possibleLoanAmounts','metrics'));
          }

           return  view('funds-application.referred-application.create',compact('possibleLoanAmounts','metrics'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
         $validatedApplicationData = $request->validate([
             'referralCode'=>[ 'required', new ReferralCodeFormat,
                 'exists:individual_referral_codes,referral_code',
                  //new CheckReferralCodeStatus
             ],
             'amountRequested'=>'required',
             'receiveMoneyDate' => 'required|date',
             'interactEmail' => 'required|email',

           // 'payBackDate'=>['required','date', new PayBackDateValidate($request->input('receiveMoneyDate'),$request->input('payBackDate'),$request->input('amountRequested'))],
           // 'autoDepositEnabled' => 'required',

        ]);


        //if referral code exist and its assigned(status 1) check that it being used by the right user
        if(Referral::where('referral_code', $request->input('referralCode'))->exists() && Referral::where('referral_code', $request->input('referralCode'))->value('status')==1) {
            $validatedApplicationData = $request->validate([
                'referralCode'=>[ 'required',new ReferralCodeBelongsToUser,
                ],
           ]);

        }


        $userId = $this->user->getUserId();
        $loanId = $this->funds->generateApplicationId();

        $userType = $this->user->getUserType();

        //determine loan type
        if($userType==User::INDIVIDUAL_USER){
            $loanType = Loan::PERSONAL_LOAN;
        }
        elseif($userType==User::BUSINESS_USER){
            $loanType = Loan::BUSINESS_LOAN;
        }

    /******** Logic for when loan applicant is referred by another user *********/
        //check if referral code exist but has not bieng assigned (status 0 ) this means user was refrred by another user
          // check if the referral code exist AND is not referral code from flyer
        if(Referral::where('referral_code', $request->input('referralCode'))->exists() && Referral::FLYER_REFERRAL_CODE != $request->input('referralCode') ) {

            //get referral code status
            $referralCodeStatus = Referral::where('referral_code', $request->input('referralCode'))->value('status');
            // check if referral code status is equal to 0 (referral code exist but not assigned)
           if($referralCodeStatus == 0){
            //assign the referral code to user
            (new \App\Services\RegisterService)->addReferralCode($userId,$request->input('referralCode'));
            //change referral code status from default of 0 to 1 (from unassigned to assigned)
            (new \App\Services\RegisterService)->changeReferralCodeStatus($request->input('referralCode'), 1);
            }
        }

    /*********************************************************/


    /***** Logic for when referral code is from flyer ********/
     //if referral code that is provided by user is from the promotional flyer
    if(Referral::FLYER_REFERRAL_CODE === $request->input('referralCode')){

        //generate new unqiue referral code for user
        $userType = User::INDIVIDUAL_USER;

        $newUserReferralCode = (new \App\Services\RegisterService)->generateReferralCode($userType,$this->user->getFirstName(),$this->user->getLastName());

        //assign the referral code to user
        (new \App\Services\RegisterService)->addReferralCode($userId,$newUserReferralCode);


        //add new referral code to referrals table for records (equivalent to dohzy recommending the user)
        $referral = new Referral;

        $referral->firstName = $this->user->getFirstName();
        $referral->lastName  = $this->user->getLastName();
        $referral->email = $this->user->getUserEmail();
        $referral->phone =  (new \App\Models\Phone)->getUserPhoneNumber($userId);
        $referral->relationship = 3;
        $referral->trust_level = 2;
        $referral->referral_code = $newUserReferralCode;
        $referral->referrer = 'Dohzy flyer';

        $referral->save(); //save info in database

        //change referral code status from default of 0 to 1 (from unassigned to assigned)
        (new \App\Services\RegisterService)->changeReferralCodeStatus($newUserReferralCode, 1);

    }



    /***********  **************/



         //store loan information to user later
         Session::put('loanId', $loanId); //store loan id in session for later use
         Session::put('userId', $userId );
         Session::put('userProvidedReferralCode', $request->input('referralCode') );
         Session::put('amountRequested', $request->input('amountRequested') );
         Session::put('receiveMoneyDate', $request->input('receiveMoneyDate') );
         Session::put('interacEmail', $request->input('interactEmail'));

         Session::put('loanSendMoneyMethod', 1 );
         Session::put('initialLoanStatus', 1 );
         Session::put('loanType', $loanType );
         Session::put('initialCharges', 0);
         Session::put('sendMoneyInteracPassword', $this->funds->generateSendInteracPassword());
         Session::put('receiveMoneyInteracPassword', $this->funds->generatePayBackInteracPassword());


         /*
         Session::put('payBackDate', $request->input('payBackDate') );
         Session::put('autoDepositEnabled', $request->input('autoDepositEnabled') );
         Session::put('userInterestRate', $this->funds->getUserInterestRate($userId));
         Session::put('loanPayBackAmount', $this->funds->initialLoanPaybackAmount($userId,$request->input('amountRequested')));
         Session::put('initialLoanBalance', $this->funds->initialLoanBalance($userId,$request->input('amountRequested'), $loanId));

         $loanSecurityScore = (new \App\Services\SecurityService)->calculateLoanSecurityScore($loanId, $userId);
         */

        /*

       /*
        $userEmail = $this->user->getUserEmail();  //get verified email that is stored in the Db
        $request->input('interactEmail')===$userEmail ? dd('emails are same') : dd('emails are diff');
        //store information in session variable to use in next steps
         $request->session()->put('interacTransferMethod', $request->input('applicationMoneyReceiveMeans'));
        //  return redirect()->route('deposit.information');
       */

        /*
        $when = now()->addMinutes(4);
        $user->notify((new ApplicationProcessedNotification($application))->delay($when));
        */

        /*
        //process application
        ProcessMoneyApplication::dispatch($application)
                                 ->onQueue('loan_applications')
                                 ->delay(now()->addMinutes(Loan::MINUTES_BEFORE_LOAN_APPLICATION_STARTS ));
         */
        // a delay is added so as to give the user time to make a change/edit and application if they made a mistake



        if($request->input('amountRequested') < 399) // non-installmental payment
          {

          // return view('funds-application.referred-application.loan-apply-no-installments');
           return redirect()->route('no-installment-loan.show');

         }

         /** this is temporal we should take it out once amounts of more than 750 logic is implemented */

         if($request->input('amountRequested') > 1000) // non-installmental payment
         {

         // return view('funds-application.referred-application.loan-apply-no-installments');
          return redirect()->route('no-installment-loan.show');

        }
          /*
        elseif(($request->input('amountRequested') < 699) && ($request->input('amountRequested') > 399)  )
        {  //two installmental payment

            return view('funds-application.referred-application.loan-apply-installment-payback');

            //return view('funds-application.referred-application.loan-apply-two-installments');
        }  */



        //return view('funds-application.referred-application.loan-apply-installment-payback');

        return redirect()->route('decide-installment-loan.show');
    }

    public function handleInstallmentsRepayment(Request $request){

         $validation = $request->validate([

            'installmentPayBack' => 'required',
         ]);

         //if yes and amount is more less than $700 route to two installments payment

         if($request->input('installmentPayBack')==1){

            if(session('amountRequested')>399 && session('amountRequested')<=700 ){

              //return view('funds-application.referred-application.loan-apply-two-installments');

              return redirect()->route('two-installments-choose');
            }

            if (session('amountRequested')>700 && session('amountRequested')<=1000){


               //return  view('funds-application.referred-application.loan-apply-choose-installments');

               return redirect()->route('choose-number-of-installments.show');

            }

         }

         return view('funds-application.referred-application.loan-apply-no-installments');

    }

    public function handleInstallmentsNumber(Request $request){

        if($request->input('possibleInstallments')==2){

            return view('funds-application.referred-application.loan-apply-two-installments');

        }

        if($request->input('possibleInstallments')==3){

            return view('funds-application.referred-application.loan-apply-three-installments');

        }

        if($request->input('possibleInstallments')==4){

            return view('funds-application.referred-application.loan-apply-four-installments');

        }

    }

    public function noInstallmentShowForm(){

        return view('funds-application.referred-application.loan-apply-no-installments');

    }

    public function decideInstallmentForm(){

        return view('funds-application.referred-application.loan-apply-installment-payback');
    }

    public function chooseNumberOfInstallmentForm(){

        return view('funds-application.referred-application.loan-apply-choose-installments');
    }

    public function noInstallmentHandle(Request $request){

        $numberOfInstallments= 1;


        //validation
         $validate = $request->validate([

         'payBackDate'=>['required','date', new PayBackDateValidate(session('receiveMoneyDate'),$request->input('payBackDate'),session('amountRequested'))],

         ]);

        $payBackDate = array("onlyPayBackDate" => $request->input('payBackDate'));

        //save payback date
        Session::put('payBackDate', $payBackDate);

        Session::put('numberOfInstallments', $numberOfInstallments);

        $specificLoanInterestRate = $this->funds->calculateSpecificLoanInterestRate(session('userId'), session('amountRequested'),session('payBackDate'),session('numberOfInstallments'));

        Session::put('userInterestRate', $specificLoanInterestRate);

        Session::put('loanPayBackAmount',  $this->funds->initialLoanPaybackAmount(session('amountRequested'),$specificLoanInterestRate));

        Session::put('initialLoanBalance', session('loanPayBackAmount'));

        return view('funds-application.referred-application.review-loan');

    }

    public function installmentRefundOption(){
        return view('funds-application.referred-application.loan-apply-installment-payback');
    }


   public function twoInstallmentsDisplayForm(){

      return view('funds-application.referred-application.loan-apply-two-installments');

   }

    public function handleTwoInstallmentsRepayment(Request $request){

        $numberOfInstallments = 2;

        $validate = $request->validate([

            //'firstInstallmentAmount' => 'required',
            'firstInstallmentPayBackDate' => 'required',
            //'secondInstallmentAmount' => 'required',
            'secondInstallmentPayBackDate' => 'required',

            'secondInstallmentPayBackDate'=>['required','date', new DatesCompare($request->input('firstInstallmentPayBackDate'))],

            ]);

        Session::put('numberOfInstallments', $numberOfInstallments);
        Session::put('firstInstallmentPayBackDate', $request->input('firstInstallmentPayBackDate'));
        Session::put('secondInstallmentPayBackDate', $request->input('secondInstallmentPayBackDate'));

        $payBackDate = array("firstPayDate"=>$request->input('firstInstallmentPayBackDate'),
                             "secondPayDate"=>$request->input('secondInstallmentPayBackDate'),
                            );

        Session::put('payBackDate', $payBackDate);

        $specificLoanInterestRate = $this->funds->calculateSpecificLoanInterestRate(session('userId'), session('amountRequested'),session('payBackDate'),session('numberOfInstallments'));

        Session::put('userInterestRate', $specificLoanInterestRate);

        Session::put('loanPayBackAmount', $this->funds->initialLoanPaybackAmount(session('amountRequested'),$specificLoanInterestRate));

        Session::put('amountPerInstallment',round($this->funds->calculateAmountPerInstallmentForTwoInstallments(session('loanPayBackAmount'), session('numberOfInstallments')), 2 ));

        Session::put('initialLoanBalance', session('loanPayBackAmount'));

        return redirect()->route('two-installments-review');

    }


    public function twoInstallmentsReview(){

        return view('funds-application.referred-application.loan-apply-two-installments-review');
    }


    public function handleThreeInstallmentsRepayment(Request $request){

        $numberOfInstallments = 3;

        $validate = $request->validate([

            'firstInstallmentPayBackDate' => 'required',
            'secondInstallmentPayBackDate' => 'required',
            'thirdInstallmentPayBackDate' => 'required',

            'secondInstallmentPayBackDate'=>['required','date', new DatesCompare($request->input('firstInstallmentPayBackDate'))],

            ]);

        Session::put('numberOfInstallments', $numberOfInstallments);
        Session::put('firstInstallmentPayBackDate', $request->input('firstInstallmentPayBackDate'));
        Session::put('secondInstallmentPayBackDate', $request->input('secondInstallmentPayBackDate'));
        Session::put('thirdInstallmentPayBackDate', $request->input('thirdInstallmentPayBackDate'));



        $payBackDate = array("firstPayDate"=>$request->input('firstInstallmentPayBackDate'),
                             "secondPayDate"=>$request->input('secondInstallmentPayBackDate'),
                             "thirdPayDate"=>$request->input('thirdInstallmentPayBackDate'),
                            );

        Session::put('payBackDate', $payBackDate);

        $specificLoanInterestRate = $this->funds->calculateSpecificLoanInterestRate(session('userId'), session('amountRequested'),session('payBackDate'),session('numberOfInstallments'));

        Session::put('userInterestRate', $specificLoanInterestRate);

        Session::put('loanPayBackAmount', $this->funds->initialLoanPaybackAmount(session('amountRequested'),$specificLoanInterestRate));

        Session::put('amountPerInstallment',round($this->funds->calculateAmountPerInstallmentForTwoInstallments(session('loanPayBackAmount'), session('numberOfInstallments')), 2));

        Session::put('initialLoanBalance', session('loanPayBackAmount'));

        return redirect()->route('three-installments-review');

    }


    public function threeInstallmentsReview(){

        return view('funds-application.referred-application.loan-apply-three-installments-review');
    }

    public function finalLoanReview(){
        return view('funds-application.referred-application.review-loan');
    }



    public function saveLoanApplication(Request $request){

        $loan = new Loan; //create instance of application model

        $loan->applicant_user_id = session('userId');
        $loan->id = session('loanId');
        $loan->application_referral_code = session('userProvidedReferralCode');
        $loan->application_amount = session('amountRequested');
        $loan->application_receive_money_date = session('receiveMoneyDate');

        if(session('numberOfInstallments')==1){

         $loan->applicant_proposed_pay_back_date = session('payBackDate')['onlyPayBackDate'];

        }
        elseif(session('numberOfInstallments')>1){

         $loan->installment_payback_status = 1;

        }

        $loan->application_interact_email = session('interacEmail');
        $loan->application_interact_autodeposit_status = session('autoDepositEnabled');
        $loan->interest_rate = session('userInterestRate');
        $loan->payback_amount = session('loanPayBackAmount');
        $loan->balance = session('initialLoanBalance');
        $loan->charges = session('initialCharges');
        $loan->application_send_money_method = session('loanSendMoneyMethod');
        $loan->application_status = session('initialLoanStatus');
        $loan->application_type = session('loanType');
        $loan->send_interac_password = session('sendMoneyInteracPassword');
        $loan->receive_interac_password = session('receiveMoneyInteracPassword');

        $loan->save(); // save information in database



        if(session('numberOfInstallments')==2 or session('numberOfInstallments')==3){

          $loanInstallmentRefund = new LoanInstallmentRefund;

          $loanInstallmentRefund->loan_id = session('loanId');
          $loanInstallmentRefund->number_of_installments = session('numberOfInstallments');

          //payback dates
          if(session('numberOfInstallments')==2){
          $loanPayBackDates = [session('firstInstallmentPayBackDate'),session('secondInstallmentPayBackDate')];
          }

          if(session('numberOfInstallments')==3){
            $loanPayBackDates = [session('firstInstallmentPayBackDate'),session('secondInstallmentPayBackDate'), session('thirdInstallmentPayBackDate')];
          }

          $loanPayBackDates = implode(",",$loanPayBackDates); //separate payback dates with comma before inserting into database

          $loanInstallmentRefund->payback_dates = $loanPayBackDates;

          $loanInstallmentRefund->amount_per_installment = session('amountPerInstallment');

          $loanInstallmentRefund->save(); // save information in database

        }

        //send notification to user that loan request has been received
        $user = Auth::user(); //User::first();
        $user->notify(new ApplicationRecievedNotification($loan));


        // send notification to admin that user applied for funds
        if(App::environment(['prod', 'production', 'stage', 'local'])) {
            //send text message to super admin
            $userAccountId = Auth::user()->account_id; //$user['account_id'];
            $this->phoneService->sendMoneyRequestMessageToAdmin(config('admin.super_admin_phone_number'), $userAccountId);

            //send text message to admin
            $userAccountId = Auth::user()->account_id; //$user['account_id'];
            //  $this->phoneService->sendMoneyRequestMessageToAdmin(config('admin.admin_phone_number'), $userAccountId);

            //send mail notification to admins(on-demand notification)
            Notification::route('mail', config('admin.super_admin_email'))
                ->notify(new LoanRequestReceivedAdminNotification());
        }


        //forget session variables for loan
        $request->session()->forget('userId');
        $request->session()->forget('userProvidedReferralCode');
        $request->session()->forget('amountRequested');
        $request->session()->forget('receiveMoneyDate');
        $request->session()->forget('payBackDate');
        $request->session()->forget('interacEmail');
        $request->session()->forget('autoDepositEnabled');
        $request->session()->forget('userInterestRate');
        $request->session()->forget('loanPayBackAmount');
        $request->session()->forget('initialLoanBalance');
        $request->session()->forget('initialCharges');
        $request->session()->forget('loanSendMoneyMethod');
        $request->session()->forget('initialLoanStatus');
        $request->session()->forget('loanType');
        $request->session()->forget('sendMoneyInteracPassword');
        $request->session()->forget('receiveMoneyInteracPassword');

        $request->session()->forget('numberOfInstallments');
        $request->session()->forget('amountPerInstallment');
        $request->session()->forget('firstInstallmentPayBackDate');
        $request->session()->forget('secondInstallmentPayBackDate');
        $request->session()->forget('thirdInstallmentPayBackDate');



        return view('funds-application.complete')->withSuccess(__('loan has been successfully received'));

    }


    public function showDepositInformationForm(Request $request){


        $userEmail = $this->user->getUserEmail();  //get verified email that is stored in the Db

        //get phone number that is on file
        $userId = $this->user->getUserId();
        $userPhoneNumber = $this->phone::where('user_id', $userId)->value('phone_number');


        if($request->session()->has('interacTransferMethod')){

            if($request->session()->get('interacTransferMethod') ==='email') {

                return view('funds-application.deposit-email')->with('userEmail', $userEmail);
            }

            if($request->session()->get('interacTransferMethod') ==='phone') {
                return view('funds-application.deposit-phone')->with('userPhoneNumber',  $userPhoneNumber);
            }

            if($request->session()->get('interacTransferMethod') ==='email-phone') {

                return view('funds-application.deposit-email-and-phone');
            }

        }

        return "!!!hmmm problem";
    }

   public function verifyDepositEmail(Request $request){

       $userEmail = $this->user->getUserEmail();  //get verified email that is stored in the Db

        //compare submitted deposit email with the one on record
       if($userEmail === $request->input('userDepositEmail')){
           //return view('funds-application.review-application');
           return redirect()->route('review.application');
       }
           return "change to deposit email.... warn user !!!!!!!";
   }

   public function verifyDepositPhone(Request $request){
       $userId = $this->user->getUserId();
       $userPhoneNumber = $this->phone::where('user_id', $userId)->value('phone_number');


        if($userPhoneNumber){
            if($userPhoneNumber === $request->input('interacDepositPhoneNumber')){
                //return view('funds-application.review-application');
                return redirect()->route('review.application');
            }

            return "change to deposit email.... warn user !!!!!!!";

        }

       return "Problem, number issues!!!!!!!";

   }

    public function verifyDepositEmailAndPhone(){
        return "verify deposit email and Phone !!!!!!!";
    }

    public function reviewApplication(Request $request)
    {
        //maybe Validate

        if ($request->session()->has('groupMemberApplication')) {

            $groupMemberApplication = $request->session()->get('groupMemberApplication');

            if($groupMemberApplication === 'yes') {
                return view('funds-application.review-group-member-application');
            }
            elseif($groupMemberApplication === 'no'){
                return view('funds-application.review-referral-application');
            }
        }
        else{
            return"Problem with application try later";
        }

    }


    public function applicationFinalize(Request $request){

        $application = $request->session()->get('application');

        $application->save();

        $application = new Loan;

        //call event to send application recieved confirmation email and text
        //event(new MoneyRequestRecieved($application));

         $useR= User::first(); //

        //dump($useR);
        //dump('--------------------');
        //dd($this->user);

         //Notification::send($useR, new ApplicationRecievedNotification());




         $useR->notify(new ApplicationRecievedNotification($application));

          ProcessMoneyApplication::dispatch()->delay(now()->addMinutes(5)); //delay dispatch of job by 5mins

        return view('funds-application.complete')->with('success', 'Loan has been successfully received');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //fetch info about specific item from the database
        $application = Loan::find($id);
        return view('funds-application.show')->with('application', $application);   //load item specific info in the view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        //fetch info about specific item from the database
        $application = Loan::find($id); // this returns single post which we put in variable NB: Post in this case is the model
        return view('funds-application.edit')->with('application', $application);   //load item specific info in the view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'applicantFirstname'=>'required',
            'applicantLastname'=>'required',
            'applicantEmail'=>'required'
        ]);

        $application = Loan::find($id);
        //column names                          //variable names in form
        $application->applicant_first_name = $request->input('applicantFirstname');
        $application->applicant_last_name  = $request->input('applicantLastname');
        $application->applicant_email = $request->input('applicantEmail');
        $application->applicant_phone_number =  $request->input('applicantPhone');
        $application->applicant_address = $request->input('applicationAmount');
        $application->application_amount = $request->input('applicantGroupName');
        $application->applicant_group =  $request->input('applicantGroupAdminName');

        $application->save();

        return redirect('/applications')->with('success', 'Loan has been successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $application = Loan::find($id);
        $application->delete();

        return redirect('/applications')->with('success', 'Loan deleted!');
    }

    public function showLoanTermsAndConditionsForm($id){

        $loanInfo = Loan::find($id);
        return view('funds-application.terms-and-conditions')->with('loanInfo', $loanInfo);

    }

    public function loanTermsAcceptPage($loanId){

        //update status of loan, to 5(loan approved and money will be sent)
        $this->funds->changeApplicationStatus($loanId, Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT);

        return view('funds-application.loan-terms-accepted');
    }

    public function loanTermsRejectPage($loanId){

        //update status of loan  status, to 9 (terms and conditions rejected)
        $this->funds->changeApplicationStatus($loanId, Loan::LOAN_TERMS_AND_CONDITIONS_REJECTED);

        return view('funds-application.loan-terms-rejected');
    }

}
