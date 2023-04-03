<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\LoanService;

class UserLoanMetricsController extends Controller
{

    public $loanService;


    public function __construct(LoanService $loanService){
    
        $this->middleware('auth');
        $this->loanService = $loanService;
       
    }

    public function getUserLoansTotal($userId){
        /** TODO: refactor this  function. use model LoanMetric to access the database */
        $loanTotal = DB::table('loans')->select('balance' )
                                         ->where([
                                             ['applicant_user_id', $userId],
                                             ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
                                         ])->sum('balance');
        return $loanTotal;
    }

    public function getSingleLoanBalance($loanId){

        return $this->loanService->singleLoanBalance($loanId);
    }

    public function getRecentLoanPaymentDueDate($userId){

        $latestDates = DB::table('loans')->select('applicant_proposed_pay_back_date' )
                    ->where([
                        ['applicant_user_id', $userId],
                        ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
                        ])->latest('applicant_proposed_pay_back_date')->value('applicant_proposed_pay_back_date');
         return $latestDates;

    }


    Public function getPossibleLoanAmounts($userId)
    {
        $loanLevel = $this->getLoanLevel($userId);

        $loanAmounts = DB::table('loan_levels')->where('loan_level', $loanLevel)->value('amounts');

        $loanAmounts = explode(',', $loanAmounts); //convert string to that was gotten from database to array

        return $loanAmounts;
    }

    /*
    // get user loan range
    public function getLoanRange($userId){

        $loanRange = []; //array to hold loan range

        $possibleLoanAmounts = $this->getPossibleLoanAmounts($userId);
        $lowerRange = $possibleLoanAmounts[0]; //get first element in array of possible amounts; used for range lower bound
        $upperRange  = sizeof($possibleLoanAmounts); //get length of array of possible amounts; used for range upper bound;
        $loanRange = array_push($loanRange,$lowerRange,$upperRange); //push upper range and lower range to array

        return $loanRange;

    }


    Public function getPossibleLoanAmounts($userId)
    {
        $loanLevel = $this->getLoanLevel($userId);

        $loanAmounts = DB::table('loan_levels')->where('loan_level', $loanLevel)->value('amounts');

        $loanAmounts = explode(',', $loanAmounts); //convert string to that was gotten from database to array

        return $loanAmounts;
    }


    public function getLoanLevel($userId){

        $fallBackLoanLevel = 3; //loan level to be used if query to get actual loan level fails

        $loanLevel = DB::table('users_loan_metrics')->where('user_id', $userId)->value('loan_level');
        if(is_null($loanLevel)){
            return $fallBackLoanLevel;
        }
        return $loanLevel;
    }
    */

}
