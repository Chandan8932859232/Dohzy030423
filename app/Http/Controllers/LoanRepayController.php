<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Notifications\UserPaymentMadeNotification;
use App\Services\LoanService;
use App\Services\PhoneService;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LoanRepay;
use Illuminate\Support\Facades\Notification;

class LoanRepayController extends Controller
{

    public $user;
    public $loanRepay;
    public $loanService;
    public $phoneService;

    public function __construct(User $user, LoanRepay $loanRepay, LoanService $loanService, PhoneService $phoneService){

        $this->middleware('auth');
        $this->user = $user;
        $this->loanRepay = $loanRepay;
        $this->loanService = $loanService;
        $this->phoneService = $phoneService;

    }

    public function showUnpaidLoans($userId){
  
        $unPaidLoans = Loan::where('applicant_user_id', '=', $userId)
              ->where(function ($query) {
              $query->where('application_status', '=',6)
                    ->orWhere('application_status', '=', 7)
                    ->orWhere('application_status', '=', 10);
               })
              ->orderBy('created_at','desc')->paginate(5);                                                        

        return view('funds-application.referred-application.unpaid-loans')->with('unPaidLoans', $unPaidLoans);

    }

    public function showLoanPayBackForm($id){
        //fetch info about specific item from the database
        $loanRequest = Loan::find($id);
        return  view('funds-application.referred-application.payback-loan')->with('loanRequest', $loanRequest);  //load item specific info in the view
     }

    //show loanRepay Form

    public function processLoanPaymentSubmission($loanId, Request $request){

        //validate input
        $request->validate([
            'amountSent'=>'required|max:50',
            'sentMoneyDate'=>'required|max:50',
            'interacPassword'=>'required|max:50',

        ]);

        //Update loan status

        $loan = Loan::find($loanId); // get particular loan

        //update status of loan  status
        $this->loanService->changeApplicationStatus($loanId, Loan::LOAN_PAYMENT_MADE_BUT_TO_BE_VERIFIED);

        //notify admins that repayment has been made
        //send email to super admin informing them of money sent
        Notification::route('mail', config('admin.super_admin_email'))
            ->notify(new UserPaymentMadeNotification($request, $loanId));

        //send email to admin informing them of money sent
        /*
        Notification::route('mail', config('admin.admin_email'))
            ->notify(new UserPaymentMadeNotification($request, $loanId));
        */

        //send text message to super admin informing them of money sent
         $this->phoneService->sendLoanPaymentMessageToAdmin(config('admin.super_admin_phone_number'), $loanId, $request->input('amountSent'), $request->input('interacPassword'));

         //send text message to admin informing them of money sent
         //$this->phoneService->sendLoanPaymentMessageToAdmin(config('admin.admin_phone_number'), $loanId, $request->input('amountSent'), $request->input('interacPassword'));

        return view('funds-application.confirm-loan-pay-back');

    }


}
