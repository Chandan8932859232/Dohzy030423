<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FundsApply extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
          //return everything in the response
        //return parent::toArray($request);

        //customize  response from API call
        return [
         //provide fields that u want to return in the API response
          'id'=> $this->id,
          'applicant_first_name'=> $this->applicant_first_name,
          'applicant_last_name' => $this->applicant_last_name,
          'applicant_email' => $this->applicant_email,
          'applicant_phone_number' => $this->applicant_phone_number,
          'applicant_address' => $this->applicant_address,
          'application_amount' => $this->application_amount,
          'applicant_group' => $this->applicant_group
        ];

    }

    //add other things to(with) the response data from the API call

    public function with($request){
        return[
            'version' => '1.0.0',
            'author_url' => url('http://kemandtech.com')
        ];
    }
}
