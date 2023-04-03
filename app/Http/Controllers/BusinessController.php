<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\BusinessAccountRequestAdminNotification;
use Illuminate\Support\Facades\Notification;
use function App\Services\countriesData;

class BusinessController extends Controller
{
    //

    public function showBusinessAccountRequestForm()
    {

        $countryInfo = countriesData();

        return view('business.request-business-account')->with('countryInfo', $countryInfo);

    }


    public function processBusinessAccountRequest(Request $request){

        //validate form data
        $this->validate($request, [
            'businessAge' => 'required',
            'businessIndustry' => 'required',
            'businessCountry' => 'required',
            'businessRevenue'=>'required',
            "businessSummary" => 'required|max:300'
        ]);

        $currentDateTime = date('Y-m-d H:i:s');
        $currentDateTimeEST = (new \App\Services\DateTimeService)->convertTimeToEST($currentDateTime);

        //insert information into database
         DB::table('business_account_request')->insert(

            [
              'user_id' => (new \App\Models\User)->getUserId(),
              'business_age' => $request->input('businessAge'),
              'business_industry' => $request->input('businessIndustry'),
              'business_country' => $request->input('businessCountry'),
              'business_revenue' => $request->input('businessRevenue'),
              'business_description' =>  $request->input('businessSummary'),
              'created_at' => $currentDateTimeEST,
              'updated_at' => $currentDateTimeEST
            ]
          );

        //send mail notification to admins(on-demand notification)
        Notification::route('mail', config('admin.super_admin_email'))
        ->notify(new BusinessAccountRequestAdminNotification());


        return view('business.confirm-business-account-request');

    }





}
