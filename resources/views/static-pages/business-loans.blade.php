@extends('layouts.guest')


@section('title', 'Business Loans')

@section('content')

<div class="jumbotron jumbotron-fluid" style="background-color:#F8F7FE" >
    <p class="text-center mt-5 static_page_topic" style="color:#312A5C" > {{__('business loans')}} </p>
</div>


  <div class="container">

   <br>
    <p style="font-size:17px;"> {{__('we rapidly offer loans to businesses and entrepeneurs with stable existing business to help them cover cashflow shortages and emergencies')}} </p>

      <br>
        <p class="featurette-heading page_topics">{{__('how much can we offer')}}</p>

          <ul>
            <li class="ml-2"> <span style="color:#000000; font-weight:bolder;"> {{__('$2000 to $10,000')}} </span> </li>
          </ul>

        <p class="featurette-heading page_topics mt-5">{{__('how long to get a response')}}</p>

          <ul>
           <li class="ml-2"> <span style="color:#000000; font-weight:bolder; "> {{__('24 hours')}}</span> </li>
          </ul>

        <p class="featurette-heading page_topics mt-5">{{__('how much does business account cost')}}</p>

          <ul>
             <li class="ml-2"> <span style="color:#000000; font-weight:bolder;"> {{__('25$ one time fee')}}</span> </li>
          </ul>


        <p class="featurette-heading page_topics mt-5">{{__('how much time do i have to payback the loan')}}</p>
           <ul>
              <li class="ml-2"> <span style="color:#000000; font-weight:bolder;"> {{__('on average between 2 to 3 months')}}</span> </li>
           </ul>

        <p class="featurette-heading page_topics mt-5">{{__('conditions to qualify')}}</p>

          <ul>

            <li class="ml-2 mb-3"> {{__('the entrepeneur should be based in canada')}} </li>
            <li class="ml-2 mb-3"> {{__('the business should be existing for at least 2 years')}} </li>
            <li class="ml-2 mb-3"> {{__('the business should be generating monthly revenues of at least $1,000')}} </li>
            <li class="ml-2 mb-3"> {{__('the entrepeneur should have a credit score of at least 620')}} </li>

          </ul>


        <p class="featurette-heading page_topics mt-5">{{__('how it works')}}</p>

          <ul>
           <li class="ml-2 mb-3"> {{__('create an account')}} </li>
           <li class="ml-2 mb-3"> {{__('go to the request center on our platform')}} </li>
           <li class="ml-2 mb-3"> {{__('request for a business account')}} </li>
           <li class="ml-2 mb-3"> {{__('within 24 hours, dohzy will approve your request and change your account to a business account, or give you a reason for dispproval')}} </li>
           <li class="ml-2 mb-3"> {{__('pay a one time fee for the business account')}} </li>
           <li class="ml-2 mb-3"> {{__('apply for a business loan with dohzy')}} </li>
          </ul>


        <p class="featurette-heading page_topics">{{__('what is the interest rate')}}</p>
          <ul>
            <li class="ml-2 mb-3">  {{__('10 to  19 %, depending on loan amount and duration')}} </li>
          </ul>



  </div>


@endsection
