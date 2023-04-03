<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanRepay;
use App\Rules\ReferralCodeFormat;
use Illuminate\Http\Request;
use App\Services\LoanService;

class UserApplicationsController extends Controller
{
    public $loanService;

    public function  __construct(LoanService $loanService)
    {
        $this->middleware('auth'); //ensure that only logged in users can access UserApplications functions
        $this->middleware('verified');
        $this->loanService = $loanService;
    }

    //
    public function index($userId){

        $userApplications = Loan::where('applicant_user_id', $userId)->orderBy('created_at','desc')->paginate(5);

        return view('funds-application.referred-application.index')->with('userApplications', $userApplications);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
      /*
        if($this->ApplyService->isGroupMemberApplication($id)){

           //fetch info about specific item from the database
            $userApplication = Loan::find($id); // this returns single post which we put in variable NB: Post in this case is the model
            return view('user.group-member-applications-edit')->with('userApplication', $userApplication);   //load item specific info in the view
       } */

     //  if($this->ApplyService->isReferredApplication($id)){
           //fetch info about specific item from the database
           $loanRequest = Loan::find($id); // this returns single post which we put in variable NB: Post in this case is the model
           return  view('funds-application.referred-application.edit')->with('loanRequest', $loanRequest);   //return 'referral application will be edited';
      // }

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
        $loanRequest = Loan::find($id);
        return  view('funds-application.referred-application.show')->with('loanRequest', $loanRequest);  //load item specific info in the view
    }


    public function showLoanRepaymentHistory($loanId){

       $loanRepayInfo = LoanRepay::where('loan_id', $loanId)->orderBy('balance', 'DESC')->get();

     
       return view('funds-application.referred-application.repayment-history')->with('loanRepayInfo', $loanRepayInfo);

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



            $validatedApplicationData = $request->validate([
                'referralCode'=>[ 'required', new ReferralCodeFormat],
                'amountRequested'=>'required',
                'receiveMoneyDate'=>'required|date|after_or_equal:today',
                'payBackDate' => 'required|date|after_or_equal:today',
                'interactEmail' => 'required|email',
                //'autoDepositEnabled' => 'required',
            ]);


        return "update application";
        /*
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
        */

        //return redirect('/user-dashboard')->with('success', 'update function to be written');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /** TODO: make this soft delete */
    public function destroy($id)
    {
        $application = Loan::find($id);
        $application->delete();

        return back()->with('success', __('loan has been deleted'));
    }

    public  function userApprove($loanId){

        $loan = Loan::find($loanId); // get particular loan

        //update status of loan  status, change from 3(awaiting approval) to 5(approved, money will be sent)
        $this->loanService->changeApplicationStatus($loanId, Loan::APPLICATION_APPROVED_AND_MONEY_WILL_BE_SENT);

        return back()->with('success', 'you have approved your loan. we are going to process this and update you, no need to call us to know the state of you application');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
         return "soft delete application";
        /*
        $application = Loan::find($id);
        $application->delete();

        return redirect('/applications')->with('success', 'Loan deleted!');
        */
    }

    public function restoreDeletedApplication($applicationId){

    }

    public function getDeletedApplication(){

    }





}
