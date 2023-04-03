<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Loan;
use App\Models\Phone;
use App\Models\User;
use App\Notifications\ApplicationProcessedNotification;
use App\Notifications\LoanApprovedNotification;
use App\Notifications\MoneySentNotification;
use App\Services\LoanService;
use App\Services\PhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\LoanRepay;

class AdminLoanHandleController extends Controller
{
    public $loanService;
    public  $phoneService;

    public function __construct(LoanService $loanService, PhoneService $phoneService){

        $this->loanService = $loanService;
        $this->phoneService = $phoneService;

    }

    //
    public function showApproveLoanForm($loanId){
        $loanInfo = Loan::find($loanId);
        return view('admin.approve-loan')->with('loanInfo', $loanInfo);

    }

    public function adminApproveUserLoan(Request $request){
        //validate form data
        $this->validate($request, [
            'requestAmount' => 'required|max:15',
            'amountApproved' => 'required|max:15',
            'interestRate'=>'required',
            'payBackAmount'=>'required|max:15',
            'sendMoneyDate'=>'required',
            'sendMoneyTime'=>'required',
            'loanId' =>'required'
        ]);



        ///////get user email
         //get userId
       //  $userIdOfApplicant = Loan::find($request->get('loanId'))->value('applicant_user_id');
        $userIdOfApplicant = DB::table('loans')->where('id', $request->get('loanId'))->value('applicant_user_id');

        $currentLoanState = DB::table('loans')->where('id', $request->get('loanId'))->value('application_status');

         //get email of applicant
          $emailOfApplicant = DB::table('users')->where('id', $userIdOfApplicant)->value('email');

          $languageOfApplicant = DB::table('users')->where('id', $userIdOfApplicant)->value('language');

        //  $phoneNumberOfApplicant = Phone::find($userIdOfApplicant)->value('phone_number');
        $phoneNumberOfApplicant = DB::table('phones')->where('user_id', $userIdOfApplicant)->value('phone_number');


        //send loan approved email, so that user can login into their account and accept loan
        //send mail notification to admins(on-demand notification)

        if(is_null($emailOfApplicant )){

            return back()->withErrors('email of applicant was not found so message was not sent');
        }

        if( is_null($phoneNumberOfApplicant)){

            return back()->withErrors('phone number of applicant was not found so message was not sent');
        }

        if( is_null($currentLoanState)){

            return back()->withErrors('Current state of loan was not found');
        }

        else {

             if($currentLoanState == Loan::APPLICATION_AWAITING_USER_APPROVAL){

                return back()->withErrors('loan has already approved');

              }elseif($currentLoanState == Loan::APPLICATION_RECEIVED ||$currentLoanState == Loan::APPLICATION_IS_PROCESSING ) {
                 //update loan status, to 3(approved, waiting user approval)
                 $this->loanService->changeApplicationStatus($request->get('loanId'), Loan::APPLICATION_AWAITING_USER_APPROVAL);
             }else{

                 return back()->withErrors('loan is not in the current state to be approved');
             }

            //send email
            Notification::route('mail', $emailOfApplicant)
                ->notify(new LoanApprovedNotification($request,$languageOfApplicant));//->locale($languageOfApplicant);

            //send loan approved text message
             $this->phoneService->sendLoanApprovedMessageByPhone($phoneNumberOfApplicant, $languageOfApplicant, $request->get('sendMoneyDate'), $request->get('sendMoneyTime'));

           return back()->with('success' , 'Your loan approval message has been sent to the user by email and text');

        }

    }


    public function showLoanSentForm($loanId){

        $loanInfo = Loan::find($loanId);
        return view('admin.loan-sent-confirm')->with('loanInfo', $loanInfo);

    }

    public function adminConfirmMoneySent(Request $request){

        //validate form data
        $this->validate($request, [
            'amountSent' => 'required|max:5',
            'interacPassword' => 'required|max:20',
            'moneyTransferMethod' => 'required',
            'loanId' =>'required'
        ]);

        /**TODO refactor this segment to reduce confusion */
        ///////get user email
        //get userId
        //  $userIdOfApplicant = Loan::find($request->get('loanId'))->value('applicant_user_id');
        $userIdOfApplicant = DB::table('loans')->where('id', $request->get('loanId'))->value('applicant_user_id');

        $currentLoanState = DB::table('loans')->where('id', $request->get('loanId'))->value('application_status');

        //get email of applicant
        $emailOfApplicant = DB::table('users')->where('id', $userIdOfApplicant)->value('email');

        $languageOfApplicant = DB::table('users')->where('id', $userIdOfApplicant)->value('language');

        //  $phoneNumberOfApplicant = Phone::find($userIdOfApplicant)->value('phone_number');
        $phoneNumberOfApplicant = DB::table('phones')->where('user_id', $userIdOfApplicant)->value('phone_number');


        //send loan approved email, so that user can login into their account and accept loan
        //send mail notification to admins(on-demand notification)

        if(is_null($emailOfApplicant )){

            return back()->withErrors('email of applicant was not found so message was not sent');
        }

        if( is_null($phoneNumberOfApplicant)){

            return back()->withErrors('phone number of applicant was not found so message was not sent');
        }

        if( is_null($currentLoanState)){

            return back()->withErrors('Current state of loan was not found');
        }

        else {
             //ensure that loan is the the correct state(5) before sending message
            if($currentLoanState != Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT ){
                return back()->withErrors('State of loan does not match this action');
            }
           elseif($currentLoanState == Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT) {
                //update loan status, to 6(approved, money sent)
                $this->loanService->changeApplicationStatus($request->get('loanId'), Loan::APPLICATION_APPROVED_AND_MONEY_SENT);
            }else{

                return back()->withErrors('loan is not in the current state to be sent');
            }

            //send email to user informing them of money sent
            Notification::route('mail', $emailOfApplicant)
                ->notify(new MoneySentNotification($request,$languageOfApplicant));

            //send money sent text message to user
            $this->phoneService->sendMoneySentMessageByPhone($phoneNumberOfApplicant,$languageOfApplicant,$request->get('amountSent'), $request->get('moneyTransferMethod'),$request->get('interacPassword') );

            return back()->with('success' , 'Your Money Sent message has been sent to the user by email and text');

        }


    }

    public function showLoanDetails($loanId){

        $loanInfo = Loan::find($loanId);

        return view('admin.loan-request-details')->with('loanInfo', $loanInfo);

    }


    public function showLoanRepayForm($loanId){

        $loanInfo = Loan::find($loanId);

        return view('admin.loan-payment-submit')->with('loanInfo', $loanInfo);

    }

    public function handleLoanRepayment(Request $request){
        //validation
         $this->validate($request, [
            'amountPaid' => 'required|max:10',
            'paymentMethod' => 'required',
            'paymentDate' => 'required',
            'loanId' =>'required'
        ]);

        //processing loan payment by registering payment and updating loan balance
        $this->loanService->processLoanRepayment($request->input('loanId'),
                                                 $request->input('amountPaid'),
                                                 $request->input('paymentDate'),
                                                 $request->input('paymentMethod'));

        //update loan state after payment
        $this->loanService->updateLoanStateAfterRepayment($request->input('loanId'));

        return back()->with('success' , 'loan balance has been updated');

    }

    public function showLoanChargeForm($loanId){

        $loanInfo = Loan::find($loanId);

        return view('admin.loan-charge-submit')->with('loanInfo', $loanInfo);

    }

    public function handleLoanCharge(Request $request){
        //validation
         $this->validate($request, [
            'chargeAmount' => 'required|max:10',
            'chargeType' => 'required|numeric',
            'loanId' =>'required'
        ]);

        //processing loan payment by registering payment and updating loan balance
        $this->loanService->addChargeToLoan($request->input('loanId'),
                                                 $request->input('chargeAmount'),
                                                 $request->input('chargeType'),
                                               );



        return back()->with('success' , 'loan charge has been applied');

    }


    public function showAdminPaymentHistory($loanId){

        $loanRepayInfo = LoanRepay::where('loan_id', $loanId)->orderBy('balance', 'DESC')->get();


        return view('funds-application.referred-application.repayment-history')->with('loanRepayInfo', $loanRepayInfo);

    }




}
