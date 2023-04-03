<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UploadCenterController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth');
        $this->middleware('verified');


    }


    public function showUploadForm(){

        return view('user.upload-center');

    }


    public function processUploadedFile(Request $request){

            //validate info
            $request->validate([
                'documentType' => 'required',
                'uploadedFile'=>'required|mimes:jpeg,jpg,png,pdf|max:7000',
            ]);

            $userId = (new \App\Models\User)->getUserId();

          // //store uploaded file in the cloud (s3,AWS)
          //  if(App::environment(['prod', 'production'])) {
          //       $userUploadedFile = $request->file('uploadedFile')->store('general-uploads', 's3');
          //  }
          // else{
          //      $userUploadedFile = $request->file('uploadedFile')->store('test-general-uploads', 's3');
          //   }
          // $userUploadedFile = Storage::disk('s3')->url($userUploadedFile);

 //store uploaded file in the cloud (s3,AWS)
 if(App::environment(['prod', 'production'])) {
  $userUploadedFile = $request->file('uploadedFile')->store('general-uploads');
}
else{
 $userUploadedFile = $request->file('uploadedFile')->store('test-general-uploads');
}
$userUploadedFile = Storage::disk()->url($userUploadedFile);




         //insert uploaded file into database
          DB::table('general_uploads')->insert(
            //['user_id' => $userId],  //check for an existing record

            [ 'user_id' => $userId,   //if does not exist create one
              'document_type' => $request->input('documentType'),
              'document_url' =>  $userUploadedFile,
              'created_at' => date('Y-m-d H:i:s') ,
              'updated_at' => date('Y-m-d H:i:s')

            ]);


            return redirect()->route('upload.center')->with('success', __('your file has been successfully uploaded. we shall verify the file and update you'));


    }

}
