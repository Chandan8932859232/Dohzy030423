<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHelpCenterController extends Controller
{
    //
    public function showHelpCenterPage(){
      return view('user.help-center');
    }

}
