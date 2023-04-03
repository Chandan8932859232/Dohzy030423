<?php
namespace App\Services;
use Illuminate\Mail\Mailable;

use Mail;

class EmailService{


public function __constructor(){

}


public function sendMoneyRequestRecievedConfirmationEmail(){
   //send email to confirm completion and reciept of application
  //we write the code for sending email in the handle method of our listener. This is the listener method get a call after the event occur.

   $data = array('name' => auth()->user()->firstname, 'email' => auth()->user()->email,'body' => 'Your Loan has been recieved');
   /*
    $data = array('name' => auth()->user()->firstname,
                  'email' => auth()->user()->email,
                  'slot' => 'Your Loan has been recieved',
                   'subcopy' =>'yeh yeh'
  );
    'vendor.mail.html.message'
    */
    Mail::send('emails.mail', $data, function($message) use ($data) {

        $message->to($data['email'])
                ->subject('Loan Recieved');
        $message->from('noreply@artisansweb.net');
    });

}


public static function sendMoneyRequestProcessedEmail(){

    $data = array('name' => auth()->user()->firstname, 'email' => auth()->user()->email,'body' => 'Your Loan has been processed');

     Mail::send('emails.mail', $data, function($message) use ($data) {
         $message->to($data['email'])
                 ->subject('Loan Processed');
         $message->from('noreply@artisansweb.net');
     });
 }



}
