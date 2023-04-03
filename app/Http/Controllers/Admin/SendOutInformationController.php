<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Notifications\SendInformationToUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Services\PhoneService;

class SendOutInformationController extends Controller
{
   
    public $phoneService;

    function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }
   

    public function showSendEmailForm(){

        return view('admin.send-email');

    }

    public function sendEmail(Request $request){

        $request->validate([
            'receiverFirstName'=>'required|string|max:30',
            'receiverLastName'=>'string|max:30',
            'receiverEmail' => 'required|max:50',
            'mailSubject'=>'required|max:50',
            'greeting'=>'required|max:50',
            'mailMessage'=>'required|max:2000',

        ]);

        //send notification(message)
        // on-demand notification is used in this case because user is not member(user) of the site
        Notification::route('mail', $request->input('receiverEmail'))
                      ->notify(new SendInformationToUserNotification($request));

        return redirect()->route('show.send-email-form')->with('success' , 'Message has been sent');
    }

    
    public function showSendTextMessageForm(){

      return view('admin.send-text-message');
    
    }


    public function sendTextMessage(Request $request){

        $request->validate([
            'phoneNumber' => 'required|max:30',
            'textMessage'=>'required|max:1000',
        ]);

        // Once validation is complete, send text message to the user
        $this->phoneService->sendTextMessageFromAdmin($request->input('phoneNumber'),$request->input('textMessage'));

        return redirect()->route('show.send-text-form')->with('success' , 'Text message has been sent');
        
    }

}
