<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanMetric;
use App\Models\User;
use App\Models\RealEstateProveDocument;
use App\Notifications\ApplicationRecievedNotification;
use App\Notifications\LoanRequestReceivedAdminNotification;
use App\Services\LoanService;
use App\Services\PhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Config;

class RealEstateLoanController extends Controller
{

    public $user;
    public $loan;
    public $realEstateProve;
    public $phoneService;


    public function __construct(User $user,  LoanService $loan, RealEstateProveDocument $realEstateProve, PhoneService $phoneService){
        $this->middleware(['auth','verified','real-estate-loan.access']);
        $this->user = $user;
        $this->loan = $loan;
        $this->realEstateProve = $realEstateProve;
        $this->phoneService = $phoneService;
    }

    public function showRealEstateOwnershipStatusForm(){

        return view('funds-application.real-estate-assist.real-estate-ownership-status');
    
    }

    public function  directRealEstateAssistance(Request $request){

          //validate the data 
          $request->validate([
            'realEstateOwnershipStatus'=>'required',
          ]);

        if($request->input('realEstateOwnershipStatus')==1){
          
            return redirect()->route('real-estate-prove');
        }

         return redirect()->route('real-estate-pre-owner.prove');

    }

    
    public function uploadRealEstatePreOwnershipForm(){

        return view('funds-application.real-estate-assist.upload-pre-real-estate-prove');

    }

    public function uploadRealEstateOwnershipForm(){
       
        return view('funds-application.real-estate-assist.upload-real-estate-prove');
    }

   public function processUploadedRealEstateOwnershipDoc(Request $request){
       
    //validate the data 
          $request->validate([
            'realEstateProveDocument'=>'required|mimes:jpeg,jpg,png,pdf,svg|max:7000',
            'documentType'=>'required'
          ]);

       //upload  the document to the cloud
       if(App::environment(['prod', 'production'])) {
        $realEstateDoc = $request->file('realEstateProveDocument')->store('real-estate-ownership-documents', 's3');
       }
      else{
        $realEstateDoc = $request->file('realEstateProveDocument')->store('test-real-estate-ownership-documents', 's3');
       }

        //get url of uploaded file
        $realEstateProveUrl = Storage::disk('s3')->url($realEstateDoc);

        RealEstateProveDocument::insert([
            'user_id' =>$this->user->getUserId(),
            'document_url' => $realEstateProveUrl,
            'document_type' => $request->input('documentType'),
        ]);

       //show loan application form
       return redirect()->route('real-estate-form')->with('info',__('document has been successfully uploaded. you can now apply for the loan'));
    }

    public function showRealEstateAssistLoanForm(){
        
        $userId = $this->user->getUserId();
        $possibleRealEstateAmounts = $this->loan->getRealEstateAssistLoanAmounts($userId);
        $metrics = LoanMetric::where('user_id', $userId)->first();


        return view('funds-application.real-estate-assist.create', compact('possibleRealEstateAmounts', 'metrics'));
    }


    public function processRealEstateAssistLoanForm(Request $request)
    {

        $validatedApplicationData = $request->validate([
            'amountRequested'=>'required',
            'receiveMoneyDate'=>'required|date|after_or_equal:today',
            'payBackDate' => 'required|date|after_or_equal:today',
            'interactEmail' => 'required|email',
        ]);

        //Once validation is complete, insert data into database,

        $userId = $this->user->getUserId();
        $loanId = $this->loan->generateApplicationId();

        $loan = new Loan;   //create instance of loan model
       
        /*
        $loan->applicant_user_id = $userId;
        $loan->id = $loanId;
        $loan->application_amount = $request->input('amountRequested');
        $loan->application_receive_money_date = $request->input('receiveMoneyDate');
        $loan->applicant_proposed_pay_back_date =  $request->input('payBackDate');
        $loan->application_interact_email =  $request->input('interactEmail');
       // $loan->application_interact_autodeposit_status =  $request->input('autoDepositEnabled');
        $loan->interest_rate = $this->loan->getUserInterestRate($userId);
        $loan->payback_amount = $this->loan->initialLoanPaybackAmount($userId,$request->input('amountRequested'));
        $loan->application_send_money_method = 1 ;
        $loan->application_status = 1;
        $loan->application_type = 2;
        $loan->send_interac_password = $this->loan->generateSendInteracPassword();
        $loan->receive_interac_password = $this->loan->generatePayBackInteracPassword();

        $loan->save();  // save information in database
        */
       
        $numberOfInstallments = 1;

        $payBackDate = array("onlyPayBackDate" => $request->input('payBackDate'));

        //save payback date
        Session::put('payBackDate', $payBackDate);

        Session::put('numberOfInstallments', $numberOfInstallments);

        //store loan information to user later
        Session::put('loanId', $loanId); //store loan id in session for later use
        Session::put('userId', $userId );
        
        Session::put('userProvidedReferralCode', $request->input('referralCode') );
        
        Session::put('amountRequested', $request->input('amountRequested') );
        Session::put('receiveMoneyDate', $request->input('receiveMoneyDate') );
        //Session::put('payBackDate', $request->input('payBackDate') );
        Session::put('interacEmail', $request->input('interactEmail'));

        $specificLoanInterestRate = $this->loan->calculateSpecificLoanInterestRate(session('userId'), session('amountRequested'),session('payBackDate'),session('numberOfInstallments'));
         
        Session::put('userInterestRate', $specificLoanInterestRate);

        Session::put('loanPayBackAmount',  $this->loan->initialLoanPaybackAmount(session('amountRequested'),$specificLoanInterestRate));

        Session::put('loanSendMoneyMethod', 1 );
        Session::put('initialLoanStatus', LOAN::APPLICATION_RECEIVED );
        Session::put('loanType', LOAN::REAL_ESTATE_LOAN );
        Session::put('sendMoneyInteracPassword', $this->loan->generateSendInteracPassword());
        Session::put('receiveMoneyInteracPassword', $this->loan->generatePayBackInteracPassword());

        $loanSecurityScore = (new \App\Services\SecurityService)->calculateLoanSecurityScore($loanId, $userId);

        return view('funds-application.real-estate-assist.review-real-estate-loan')->withSuccess('Loan has been successfully received');

    }

    public function saveRealEstateLoanApplication(Request $request){

     $loan = new Loan; //create instance of application model

     $loan->applicant_user_id = session('userId');
     $loan->id = session('loanId');
     $loan->application_referral_code = session('userProvidedReferralCode');
     $loan->application_amount = session('amountRequested');
     $loan->application_receive_money_date = session('receiveMoneyDate');
     $loan->applicant_proposed_pay_back_date = session('payBackDate')['onlyPayBackDate'];
     $loan->application_interact_email = session('interacEmail');
     $loan->interest_rate = session('userInterestRate');
     $loan->payback_amount = session('loanPayBackAmount');
     $loan->application_send_money_method = session('loanSendMoneyMethod') ;
     $loan->application_status = session('initialLoanStatus');
     $loan->application_type = session('loanType');
     $loan->send_interac_password = session('sendMoneyInteracPassword');
     $loan->receive_interac_password = session('receiveMoneyInteracPassword');

     $loan->save(); // save information in database


     //send notification to user that loan request has been received
     $user = Auth::user();

     $user->notify(new ApplicationRecievedNotification($loan));
     
     // send notification to admin that user applied for funds
     if(App::environment(['prod', 'production', 'stage', 'dev', 'local'])) {
       //send text message to super admin
       $userAccountId = Auth::user()->account_id; //$user['account_id'];
       $this->phoneService->sendMoneyRequestMessageToAdmin(config('admin.super_admin_phone_number'), $userAccountId);
     
       //send text message to admin
       $userAccountId = Auth::user()->account_id; //$user['account_id'];
        //$this->phoneService->sendMoneyRequestMessageToAdmin(config('admin.admin_phone_number'), $userAccountId);
     
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
     $request->session()->forget('userInterestRate');
     $request->session()->forget('loanPayBackAmount');
     $request->session()->forget('loanSendMoneyMethod');
     $request->session()->forget('initialLoanStatus');
     $request->session()->forget('loanType');
     $request->session()->forget('sendMoneyInteracPassword');
     $request->session()->forget('receiveMoneyInteracPassword');

     return view('funds-application.complete')->withSuccess(__('loan has been successfully received'));

    }



}
