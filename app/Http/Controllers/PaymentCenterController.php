<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentCenterController extends Controller
{
    //

    public function showPaymentCenterForm(){

        return view('user.payment-center-form');

      }
}
