<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function getTotalUsers(){
        $usersTotal = DB::table('users')->count();
        return $usersTotal;
    }

    public function getTotalUsersForAYear($year){
        $usersForAYear = DB::table('users')
                             ->whereYear('created_at', '=', $year)
                             ->count();
        return $usersForAYear;
    }


    public function getTotalFemaleUsers(){
        $femalesTotal = DB::table('users')
                           ->where('gender','f')
                           ->count();
        return $femalesTotal;
    }

    public function getTotalMaleUsers(){
        $malesTotal = DB::table('users')
                        ->where('gender','m')
                        ->count();
        return $malesTotal;
    }


    public function getAverageUsersAge(){
        $averageDateOfBirth = DB::table('users')
                                  //->select('birth_date')
                                  ->avg('birth_date');
          $averageAge =  date('Y') - $averageDateOfBirth;
         return ceil($averageAge);
    }

    public function getTotalNumberOfLoans(){
        $numberOfLoans = DB::table('loans')
                        ->count();
        return $numberOfLoans;
    }

    public function getTotalNumberOfLoansForAYear($year){
        $numberOfLoans2021 = DB::table('loans')
                             ->whereYear('created_at', '=', $year)
                             ->count();
        return $numberOfLoans2021;
    }

    public function getTotalLoanedAmount(){
        $loanTotal = DB::table('loans')->select('application_amount' )
                                         ->sum('application_amount');
        return $loanTotal;
    }
/*
    public function getTotalLoanedAmountForAYear($year){

        $loanTotal = DB::table('loans')->select('application_amount' )
        ->whereYear('created_at', '=', $year)
        ->where([
            ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
        ])->sum('application_amount');
        return $loanTotal;
    }
*/


    public function getTotalLoanedAmountForAYear($year){

        $loanTotal = DB::table('loans')->select('application_amount' )
        ->whereYear('created_at', '=', $year)
        ->where([
            ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
        ])->sum('application_amount');
        return $loanTotal;

    }



    public function getAverageIndividualLoanedAmount(){
        $loanTotal = DB::table('loans')->select('application_amount' )
                                         ->where('application_type','=', Loan::PERSONAL_LOAN)
                                         ->avg('application_amount');
                                         /*
                                         ->where([
                                             ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
                                         ])->avg('application_amount');*/
        return $loanTotal;
    }

    public function getAverageIndividualLoanedAmountForAYear($year){
        $averageIndividualLoanedAmount = DB::table('loans')->select('application_amount' )
                                         ->whereYear('created_at', '=', $year)
                                         ->where('application_type','=', Loan::PERSONAL_LOAN)
                                         ->avg('application_amount');
                                         /*
                                         ->where([
                                             ['application_status', Loan::APPLICATION_APPROVED_AND_MONEY_SENT]
                                         ])->avg('application_amount');*/
        return $averageIndividualLoanedAmount;
    }









}
