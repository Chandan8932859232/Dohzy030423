<?php

namespace App\Http\Controllers\Investor;


use App\Http\Controllers\Controller;


class InvestorDashboardController extends Controller
{




 //show register form page
    public  function showInvestorDashboard(){

        return view('investor.dashboard');

    }




}
