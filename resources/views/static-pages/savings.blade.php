@extends('layouts.guest')


@section('title', 'Savings')

@section('content')


<div class="jumbotron jumbotron-fluid" style="background-color:#F8F7FE" >
    <p class="text-center mt-5 static_page_topic" style="color:#312A5C" > {{__('savings program')}} </p>
</div>


  <div class="container">
    <p style="font-size:16px; line-height: 2;">
    {{__('in some parts of central africa this is known as Tontine (Ivory coast, Cameroon ), in other parts its known as Likelele (Congo), but essentially the concept is that you save a fixed amount money each month over a fixed period of time and at the end of savings period, you receive everything you saved. The advantage is that you could recieve the full amount you were savings even before the end of savings period. So for example if you were to save 200 every month to get $2,000 after 10 months. You could get the $2,000 after just 2 months of contribution then continue contributing $200 every month over the next 9 months')}}
   </p>

    <p class="featurette-heading page_topics mt-5">{{__('conditions to qualify')}}</p>
      <ul>
       <li class="ml-2 mb-2">  {{__('must be based in canada')}} </li>
       <li class="ml-2 mb-2">   {{__('must be employed')}} </li>
       <li class="ml-2 mb-2">   {{__('must be a Dohzy member with a high Dohzy score( 13 and above )')}} </li>
      </ul>


    <p style="font-weight:bold; font-size:18px; margin-top:40px;">{{__('please note that this is a paid service at Dohzy')}}</p>


    <p class="featurette-heading page_topics mt-5">{{__('how it works')}}</p>

     <ul>
        <li class="ml-2 mb-2">  {{__('within the dohzy platform request to participate in the savings program')}} </p>
        <li class="ml-2 mb-2">  {{__('in the request you will choose how much you can contribute per month and how much you want to receive')}} </p>
        <li class="ml-2 mb-2">  {{__('dohzy will provide you a response within 48 hours')}} </p>
        <li class="ml-2 mb-2">  {{__('once approved, you have to pay a particiption fee')}} </p>
        <li class="ml-2 mb-2">  {{__('once payment is received, your account will be configured and set up for you')}} </p>
        <li class="ml-2 mb-2">  {{__('you can then make your monthly contributions in the platform and you also receive your contribution through the platform')}} </p>
      </ul>


  </div>


@endsection
