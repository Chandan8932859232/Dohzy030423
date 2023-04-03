<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoanService;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoansController extends Controller
{

    public $loanService;


    public function __construct(LoanService $loanService){

        $this->loanService = $loanService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$applications = Loan::all();
        $applications = Loan::orderBy('created_at','desc')->paginate(10);
        return view('funds-application.index', compact('applications'));
    }


    public function showChangeLoanLimitForm($userId){

        $userInfo = User::find($userId);

        $currentLoanLevel =$this->loanService->getLoanLevel($userId);

        return view('admin.loan-limit-change')->with('userInfo', $userInfo)->with('currentLoanLevel', $currentLoanLevel);

    }


    public function changeLoanLimit(Request $request){

          //validation
          $this->validate($request, [
            'userId' => 'required',
            'targetLoanLevel' =>'required|numeric'

        ]);

        $this->loanService->changeUserLoanLimit($request->input('userId'), $request->input('targetLoanLevel'));

        return back()->with('success' , 'loan limit has being changed');

    }


}
