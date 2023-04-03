<?php

namespace App\Http\Controllers;

use Session;

use App\Notifications\SendContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    //show contact form page (/contact)
    public  function showForm (){
     return view('static-pages.contact');
    }

    //send email (/contact)
    public function sendEmail(Request $request){
      //validate
      $this->validate($request, [
        'name'=>'required|max:100|string',
        'email'=>'required|email|max:50',
        'phoneNumber'=>'required|numeric',
        'message'=>'required|max:300'
      ]);
    //send notification(message)
       // on-demand notification is used in this case because user is not member(user) of the site
       Notification::route('mail', 'info@dohzy.com')

            ->notify(new SendContactNotification($request));

        return redirect()->route('contact.us')->with('success' , __('your message has been sent we will get back to you as soon as possible'));

    }//end sendEmail


}
