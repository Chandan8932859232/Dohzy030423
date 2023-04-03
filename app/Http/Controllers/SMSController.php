<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AWS;

class SMSController extends Controller
{
    /*
   Here we create an SNS client ($sms) using AWS::createClient() method 
   and then we can send a message by calling the publish() method on the client object ($sms) . 
   We must pass some necessary options to publish() such as a message, phone_number and SMSType (Transactional or Promotional)
    */

    protected function sendSMS($phone_number){
        $sms = AWS::createClient('sns');
    
        $sms->publish([
                'Message' => 'Hello, This is just a test Message',
                'PhoneNumber' => $phone_number,    
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                     ]
                 ],
              ]);
    }
}
