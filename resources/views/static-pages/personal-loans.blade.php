@extends('layouts.guest')


@section('title', 'Personal Loans')

@section('content')


<div class="jumbotron jumbotron-fluid" style="background-color:#F8F7FE" >
    <p class="text-center mt-5 static_page_topic" style="color:#312A5C" > {{__('personal loans')}} </p>
</div>

  <div class="container">

    <div class="row">

        <div class="col-sm-5">

            <div>
                <br> <br>

                <p style="font-size:17px; line-height: 2;">
                {{__('we understand the financial needs of our clients and provide them with fast micro loans to help cover sudden cash needs. Our personal loans are ideal for people in need of a small amount of money but are uncomfortable to ask a friend or family member and for people with limited access to other credit facilities because they have not yet spent a lot of time in Canada')}}.
                </p>

                <p class="featurette-heading page_topics">{{__('how much can we offer')}}</p>

                  <ul>
                    <li class="ml-2"> <span style="color:#000000; font-weight:bolder; font-size:16px;"> {{__('$200 to $5,000')}} </span> </li>
                  </ul>


                <p class="featurette-heading page_topics mt-5">{{__('how long to get a response')}}</p>
                  <ul>
                   <li class="ml-2">  <span style="color:#000000; font-weight:bolder; font-size:16px;"> {{__('24 hours')}}</span> </li>
                  </ul>

            </div>

        </div>


       <div class="col-sm-7 pt-5">


        <iframe width="100%" height="400"
        src="https://www.youtube.com/embed/YvaDHJkkGtQ">

        </iframe>

      </div>



    </div>


        <p class="featurette-heading page_topics mt-5">{{__('conditions to qualify')}}</p>

          <ul>
              <li class="ml-2 mb-2"> {{__('must be based in canada')}} </li>
              <li class="ml-2">  {{__('must be employed')}} </li>
          </ul>



        <p class="featurette-heading page_topics mt-5">{{__('how it works')}}</p>

           <ul>
            <li class="ml-2 mb-2"> {{__('create an account')}} </li>
            <li class="ml-2 mb-2"> {{__('apply for a dohzy loan')}} </li>
            <li class="ml-2 mb-2"> {{__('if approved, the funds will be sent to by interac or bank deposit within 24 hours')}} </li>
           </ul>



        <p class="featurette-heading page_topics mt-5">{{__('what is the interest rate')}}</p>
           <ul>
            <li class="ml-2 mb-2"> {{__('10 to  19 %, depending on loan amount and duration')}} </li>
           </ul>



  </div>


@endsection
