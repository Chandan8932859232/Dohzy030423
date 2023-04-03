<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Http\Resources\FundsApply as ApplicationResource;
use App\Http\Requests;


class FundsApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all applications
        $applications = Loan::paginate(15);

        //return a collection of applications as resource
        return ApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store an application to the database; ie stores POST request
          $application = new Loan;

          //$application->id = $request->input('applicationId');
          $application->applicant_first_name = $request->input('applicantFirstname');
          $application->applicant_last_name = $request->input('applicantLastname');
          $application->applicant_email = $request->input('applicantEmail');

          if($application->save()) { //save application
            //return a copy of what was saved
            return new ApplicationResource($application);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //show individual(specified) application
       $application = Loan::findorFail($id);

       //return a single application as a resource
       return new ApplicationResource($application);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $application = Loan::findorFail($id);

       // $application->id = $request->input('applicationId');
        $application->applicant_first_name = $request->input('applicantFirstname');
        $application->applicant_last_name = $request->input('applicantLastname');
        $application->applicant_email = $request->input('applicantEmail');

        if($application->save()) { //save application
            //return a copy of what was saved
            return new ApplicationResource($application);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get individual(specified) application whose id was passed in request
       $application = Loan::findorFail($id);


       if($application->delete()) { //delete application
        //return a copy of what was deleted
          return new ApplicationResource($application);
       }
    }
}
