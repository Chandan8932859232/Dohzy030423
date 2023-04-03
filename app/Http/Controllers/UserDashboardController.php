<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoanMetric;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public  $user;

    public function __construct(User $user)
    {

        $this->middleware('auth')->except('home');  //middleware to make sure only logged in user can access userProfile
        $this->middleware('verified');   //only users with verified email can access page

        $this->user = $user;

    }

    public function index(){

        $userId = $this->user->getUserId();
        $metrics = LoanMetric::where('user_id', $userId)->first();
        return view('user.dashboard')->with('metrics', $metrics);
    }


}
