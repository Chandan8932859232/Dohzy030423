<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayStub;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PayStubController extends Controller
{

    //public $user;

    public function __construct(){

        $this->middleware('auth');

        //$this->user = $user;

    }
    //
    public function showUploadPayStubForm(){

        return view('user.upload-paystub');
    }


    public function processUploadedPayStub(Request $request){

       //validate info
        $request->validate([
           'payStub'=>'required|mimes:jpeg,jpg,png,pdf|max:7000',
         ]);

        $userId = (new \App\Models\User)->getUserId();

        //store uploaded file in the cloud (s3,AWS)
        // if(App::environment(['prod', 'production'])) {
        //     $uploadedPayStub = $request->file('payStub')->store('pay-stubs', 's3');
        //  }
        // else{
        //        $uploadedPayStub = $request->file('payStub')->store('test-pay-stubs', 's3');
        //  }
        // $uploadedPayStubUrl = Storage::disk('s3')->url($uploadedPayStub);

        if(App::environment(['prod', 'production'])) {
            $uploadedPayStub = $request->file('payStub')->store('pay-stubs');
         }
        else{
               $uploadedPayStub = $request->file('payStub')->store('test-pay-stubs');
         }
        $uploadedPayStubUrl = Storage::disk()->url($uploadedPayStub);

        //store the information
        $payStub = new PayStub;

        $payStub->user_id = $userId;
        $payStub->pay_stub_link = $uploadedPayStubUrl;
        $payStub->created_at = date('Y-m-d H:i:s');
        $payStub->updated_at = date('Y-m-d H:i:s');

        $payStub->save();  // save bank information to database

        return view('user.upload-paystub-confirm');

    }







    }







