<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestCenterController extends Controller
{
    //
    public function showRequestCenterForm(){

      return view('user.request-center-form');
    }


}
