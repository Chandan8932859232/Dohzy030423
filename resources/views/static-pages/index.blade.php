@extends ('layouts.guest')

@section('title', 'Home')

@section('description', 'A platform that provides financial services like micro loans, insurance, mortgages')
@section('money', 'burrow, insurance, mortgage, loans,')
<!--
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days') -->

@section('content')

 {{--<div class="container"> --}}
    <div class="row" style="background-color: #f8f7fe;">
        {{--
        <div class="col-md-8" style="background:url('{{asset('images/Desktop4.jpg')}}'); background-repeat:no-repeat; background-size: auto 100%;   ">

        </div>
        --}}



        <div class="container mt-3 mb-5">

            <div class="row">

                <div class="col-sm-5">

                    <p class="home_tagline"> {{__('we provide rapid financial')}} {{__('help in times of need')}}</p>

                    <p class="sub_home_tagline"> {{__('we support the community with micro loans, savings and financial education')}}.</p>

                    <p class="home_tagline_button_box"><a class="btn  btn-outline-success btn-lg slide_buttons"  href="{{route('user.register')}}" role="button"> <span style="color:black; font-weight:bold;">{{__('join today')}}</span></a></p>
                    <br>

                </div>


               <div class="col-sm-7 pt-5">


                <iframe width="100%" height="480"
                src="https://www.youtube.com/embed/ru6tOF8xwfI">

                </iframe>

              </div>



            </div>
        </div>





 <!--
        <div class="jumbotron jumbotron-fluid home_slide">



        </div>
-->

  <!--
        <div class="slide_text_position">

            <p  class="text-center home_slide_explain">{{__('we provide rapid financial')}} <br>{{__('help in times of need')}}</p>
             <p class="text-center home_button"><a class="btn  btn-outline-success btn-lg slide_buttons ml-5" style="color:white;" href="{{route('funds-apply.create')}}" role="button"> {{__('join today')}}</a></p>
        </div>
         -->


       <!--
        <div class="col-md-8">

        <div class="jumbotron jumbotron-fluid" style="background:url('{{ asset('images/Desktop4.jpg') }}');background-repeat: no-repeat; background-size: 100% 100%; height:350px; width:100%;">
            {{--
            <div style="color:#251F4F">
                <h4 class="text-center">We Provide Rapid Financial Help In Times Of Need </h4>
                <br><p class="text-center"><a class="btn  btn-primary slide_buttons" href="{{route('funds-apply.create')}}" role="button"> <i class="fas fa-money-bill-wave"></i> Apply For Funds</a></p>
            </div>
            --}}
        </div>

        </div>


        <div class="col-md-2" style="background-color: #685EA6; background-size: auto 100%;
        display: flex;
        width: 100%;"> <br><br><br>

            <div style="color:#251F4F;"  class="text-center" >
                <p style="font-size:25px; font-weight:500;">We Provide Rapid Financial Help In Times Of Need </p>

                <p class="text-center"><a class="btn  btn-primary slide_buttons" href="{{route('funds-apply.create')}}" role="button"> <i class="fas fa-money-bill-wave"></i> Apply For Funds</a></p>
            </div>

        </div> -->

    </div>

 {{--</div>--}}


{{--
 <div class="home_tagline">
     <p class="text-center" style="font-size:27px;font-weight: 800; color:#312A5C; padding-bottom:14px;"> {{__('we provide rapid financial')}} {{__('help in times of need')}}</p>
      <p class="text-center"><a class="btn  btn-outline-success btn-lg slide_buttons"  href="{{route('user.register')}}" role="button"> <span style="color:white;">{{__('join today')}}</span></a></p>
     <br>
     <hr>
 </div>
 --}}


    <main role="main" style="background-color: #ffffff;">


       {{-- <p class="company_tagline_text">{{__('fast')}} {{__('simple')}} {{__('reliable')}}</p>--}}


     <!-- Marketing messaging and featurettes
     ================================================== -->
     <!-- Wrap the rest of the page in another container to center all the content. -->

     <div class="container marketing">


        <p class="text-center" style="padding-top:90px; font-weight:900; font-size:40px; color:#312A5C;">{{__('our services')}}</p>

        {{--<hr style="border: none; border-bottom: 0px solid; border-radius:4px; height:8px; width:15%; background-color:#FFC700;">--}}



       <!-- Three columns of text below the carousel -->

       <div class="row">




         <p style="padding:10px;"> </p>

       <!-- START THE FEATURETTES -->




      <div class="row mb-5">

        <div class="col-md-4 mb-5">

            <div class="card">

              <img class="card-img-top" src="{{ asset('images/Loans.png') }}" alt="dohzy loans image">

            </div>


            <p class="card-text" style="background-color:#FFC700; font-size:35px; font-wieght:900; color:#312A5C; text-align:center;">{{__('personal loans')}}</p>

            <p class="lead mt-2 ml-1 mr-1" style="line-height:1.9;">{{__('we offer loans to clients')}}.</p>

            <p class="services_button"><a class="btn btn-outline-dohzy" href="{{route('static-pages.personal-loans')}}" role="button"> {{__('view details')}} &raquo;</a></p>

        </div><!-- /.col-lg-4 -->



        <div class="col-md-4 mb-5">

            <div class="card">
              <img class="card-img-top" src="{{ asset('images/Business.png') }}" alt="dohzy business loans image">

            </div>

            <p class="card-text" style="background-color:#FFC700; font-size:35px; font-wieght:900; color:#312A5C; ; text-align:center;">{{__('business loans')}}</p>

            <p class="lead mt-2 ml-1 mr-1" style="line-height:1.9;">{{__('we offer business loans')}}.</p>

            <p class="services_button"><a class="btn btn-outline-dohzy" href="{{route('static-pages.business-loans')}}" role="button">{{__('view details')}} &raquo;</a></p>

      </div><!-- /.col-lg-4 -->



        <div class="col-md-4 mb-5">

            <div class="card">

             <img class="card-img-top" src="{{ asset('images/Savings.png') }}"  alt="dohzy savings image">

           </div>

           <p class="card-text" style="background-color:#FFC700; font-size:35px; font-wieght:900; color:#312A5C; ; text-align:center;">{{__('savings')}}</p>

           <p class="lead mt-2 ml-1 mr-1" style="line-height:1.8;">{{__('we offer savings')}}.</p>

           <p class="services_button"><a class="btn btn-outline-dohzy" href="{{route('static-pages.savings')}}" role="button"> {{__('view details')}} &raquo;</a></p>

       </div><!-- /.col-lg-4 -->











     </div><!-- /.row -->




    <div class="row featurette" style="background-color: #ffffff;">

        <div class="col-md-7 order-md-2 mt-5">

          <p class="featurette-heading site_topics">{{__('why dohzy')}}?<!-- <span class="text-muted">See for yourself.</span>--></p>

            <ul class="lead">
                <li class="mb-2 mt-4"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('speed')}} : </span> {{__('response time to all of our services is 24 hours')}}</li>
                <li class="mb-2 mt-2"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('customised')}} : </span> {{__('our services are tailored to the needs of our clients')}} </li>
                <li class="mb-3 mt-2"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('privacy')}} : </span>  {{__('all transactions within dohzy stay with dohzy are not shared with any third parties')}}</li>
            </ul>

            <p class="home_page_join_button"> <a class="btn  btn-success btn-lg slide_buttons"  href="{{route('user.register')}}" role="button"> <span style="color:black; font-weight:bold;">{{__('join today')}}</span></a></p>

        </div>


        <div class="col-md-5"
          {{---   style="background:linear-gradient(to right, rgba(26,15,84,0.5), rgba(131,72,166,0.5)),url('{{ asset('images/5.jpg') }}');
             background-repeat: no-repeat;
             background-size: 100% 100%;" --}}>
          <img  class="featurette-image image-fluid mx-auto" style="width:100%; height :100%;" src="{{ asset('images/Website graphics black family.png') }}"    alt="Dohzy our users image">
        </div>
      </div>





{{--
<div class="row mb-5">

  <h1 class="text-center col-md-12" style="margin-top:40px; padding-bottom:70px; font-weight:900; color:#312A5C;">{{__('how it works')}} ?</h1>

  <div class="col-lg-4 home_page_steps">
    <a href="{{route('user.register')}}" style="text-decoration: none;">
    <div class="text-center"> <img  src="{{ asset('images/create-account-step.png') }}" alt="Generic placeholder image" width="100" height="100"> </div>
     <h3 class="steps mt-3">{{__('create account')}} </h3>
    </a>
  <p class="lead">{{__('easily sign up and complete your account no long requirements needed')}}</p>
   <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
 </div><!-- /.col-lg-4 -->

 <div class="col-lg-4 home_page_steps">
    <a href="{{route('funds-apply.create')}}" style="text-decoration: none;">
    <div class="text-center"> <img  src="{{ asset('images/apply-for-funds-step.png') }}" alt="Generic placeholder image" width="100" height="100"> </div>
     <h3 class="steps mt-3">{{__('apply for funds')}}</h3>
    </a>
   <p class="lead">{{__('apply by for funds by using a referral code provided by us or another user')}}</p>
   <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
 </div><!-- /.col-lg-4 -->

 <div class="col-lg-4 home_page_steps">
    <a href="{{route('user-dashboard')}}" style="text-decoration: none;">
    <div class="text-center"> <img  src="{{ asset('images/receive-money-step.png') }}" alt="Generic placeholder image" width="100" height="100"> </div>
      <h3 class="steps mt-3">{{__('receive funds')}}</h3>
     </a>
     <p class="lead">{{__('receive money')}} <strong>{{__('twelve hours')}}</strong> {{__('after application through interac etransfer or paypal')}}</p>
     <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
   </div><!-- /.col-lg-4 -->
  </div>
--}}

 </div><!-- /.row -->







      <h1 class="text-center site_topics" style="padding-top:200px; padding-bottom:50px; font-weight:900; color:#312A5C;">{{__('features')}}</h1>

      <div class="row mb-5">

        <div class="col-md-6 mb-5">
            <div class="card" style="background-color:#ffffff; border:none;">

            <div class="card-body">

                <div class="text-center">
                   {{-- <img src="{{ asset('images/dohzy score.png') }}" alt="dohzy score image" class="text-left"> --}}
                 </div>

               <p class="card-text" style="background-color:#F1F0FF; font-size:27px; font-wieght:900; color:#300854;  text-align:center; margin-top:35px;">Dohzy Score</p>

               <div style="color:#000000; font-size: 23px; font-weight:500; text-align: left;">{{__('the Dohzy Score is similar to credit score')}}. </div>

            </div>
            </div>
        </div>



        <div class="col-md-6 mb-3">
            <div class="card" style="background-color:#fffffff; border:none;">

            <div class="card-body">

               <div class="text-center">
                {{--  <img src="{{ asset('images/referal.png') }}" alt="dohzy referral image"> --}}
               </div>

               <p class="card-text" style="background-color:#F1F0FF; font-size:30px; font-wieght:900; color:#300854; text-align:center; margin-top:35px;">{{__('referrals')}}</p>

               <div style="color:#000000; font-size: 23px; font-weight:500; text-align: left;">{{__('Dohzy believes in the power of community. The platform allows you to recommend contacts you trust. Recommendation increases approval chances')}}. </div>

            </div>
            </div>
        </div>


        <div class="col-md-6 mb-3">
            <div class="card" style="background-color:#fffffff; border:none;">

            <div class="card-body">

               <div class="text-center">
                {{--  <img src="{{ asset('images/data driven.png') }}" alt="dohzy analytics image"> --}}
               </div>

               <p class="card-text" style="background-color:#F1F0FF; font-size:30px; font-wieght:900; color:#300854;  text-align:center; margin-top:35px;">{{__('data driven')}}</p>

               <div style="color:#000000; font-size: 23px; font-weight:500; text-align: left;">{{__('The platform is data driven and highly customised. Benefits, interest rates, loan range are all based on how you use the system')}}. </div>

            </div>
            </div>
        </div>


        <div class="col-md-6 mb-3">
            <div class="card" style="background-color:#fffffff; border:none;">

            <div class="card-body">

               <div class="text-center">
                {{-- <img src="{{ asset('images/security.png') }}" alt="dohzy security image"> --}}
               </div>

               <p class="card-text" style="background-color:#F1F0FF; font-size:30px; font-wieght:900; color:#300854;  text-align:center; margin-top:35px;">{{__('secure')}}</p>

               <div style="color:#000000; font-size: 23px; font-weight:500; text-align: left;"> {{__('Dohzy uses state of the art encryption and security protocols to protect the valuable information while abiding by the law')}}. </div>

            </div>
        </div>



  </div><!-- /.row -->








</div>

 {{--
  <br><br><br>
  <iframe width="100%" height="500"
  src="https://www.youtube.com/embed/_mDhRM1j1jE">
  </iframe>
  <br><br><br><br><br>
--}}

  {{--
  <div class="container-fluid" style="background-color:#e9ecef; margin-top:80px; margin-bottom:50px;">

    <div class="container">

    <h2  style="color:#312A5C; padding-top:45px;">Are You In A Difficult Cash Flow Situation ?</h2>

   <div class="row">
    <div class="col-md-8">
    <p class="mt-3 lead">We can help you. Our state of the art platform will rapidly process your request for funds
        and within a matter of hours funds could be provided to help fix your issue and relieve you off stress
    </p>
    </div>
    <div class="col-md-2">
     <p class="float-right mt-4"><a class="btn btn-lg btn-primary slide_buttons" href="{{route('user.register')}}" role="button">Join Today</a></p>

    </div>
   </div>

    <br><br>

    </div>

</div>  --}}


       <!-- ---------- -->



       <div class="row featurette">

         <div class="col-md-7 site_explainer">

           <p class="featurette-heading site_topics">{{__('advantages')}}<!--<span class="text-muted">It'll blow your mind.</span> --></p>

           <p class="lead" style="line-height: 1.7; text-align: justify;">{{--{{__('we understand')}}--}}</p>

             <ul class="lead">
                <li class="mb-2 mt-2"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('growth')}} : </span> {{__('we reward proper behaviour and allow you to progress within the system')}}</li>
                <li class="mb-2 mt-2"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('networking')}} : </span> {{__('we enable networking, marketing and collaboration within members of the dohzy network')}} </li>
                <li class="mb-0 mt-2"><span style="color:#300854; font-size:20px; font-weight:700;">{{__('fairness')}} : </span>  {{__('users are evaluated on history and patterns of behaviour and not a particular moment in time')}}</li>
              </ul>

           <p class="home_page_join_button"> <a class="btn  btn-success btn-lg slide_buttons"  href="{{route('user.register')}}" role="button"> <span style="color:black; font-weight:bold;">{{__('join today')}}</span></a></p>

         </div>



         <div class="col-md-5 mt-5"
         {{--style="background:linear-gradient(to right, rgba(26,15,84,0.2), rgba(131,72,166,0.2)),url('{{ asset('images/2.jpg') }}');
                background-repeat: no-repeat;
                background-size: 100% 100%;"--}} >
             <br><br>


           <img class="image_home_page" style="border-radius:10px;" src="{{ asset('images/2.jpg') }}"
                  alt="dohzy advantages image"> <br><br>

         </div>



       </div>


       {{--<hr class="featurette-divider">--}}

         <p class="intersection_space_one"> </p>

       <div class="row featurette">
         <div class="col-md-7 order-md-2 site_explainer">
           <p class="featurette-heading site_topics">{{__('our users')}}<!-- <span class="text-muted">See for yourself.</span>--></p>
           <p class="lead" style="line-height: 1.7; text-align: justify;">{{__('where you were born and when you came to this country')}}</p>

             <ul class="lead">
                 <li>{{__('recently landed immigrant without an established credit score')}}</li>
                 <li>{{__('people that have resolved their past financial issues but still getting punished')}} </li>
                 <li>{{__('someone that is organized with money but ran into a cash flow emergency')}} </li>
             </ul>

         </div>
         <div class="col-md-5 mt-5"
           {{---   style="background:linear-gradient(to right, rgba(26,15,84,0.5), rgba(131,72,166,0.5)),url('{{ asset('images/5.jpg') }}');
              background-repeat: no-repeat;
              background-size: 100% 100%;" --}}> <br>
           <img  class="featurette-image image-fluid img-fluid mx-auto" style="border-radius:10px;" src="{{ asset('images/dohzy-our-users.png') }}"    alt="Dohzy our users image">
         </div>
       </div>


      {{-- <hr class="featurette-divider">--}}

         <p class="intersection_space_one"> </p>

       {{--
         <div class="row featurette">
         <div class="col-md-7 site_explainer">
           <p class="featurette-heading site_topics" >{{__('conditions to qualify')}} <!-- <span class="text-muted">Checkmate.</span>--></p>
           <p class="lead" style="line-height: 1.7; text-align: justify;">{{__('we use communal approach')}}</p>
             <ul class="lead  advantages_list">
                 <li>{{__('get referred by someone we trust they will give you a referral code')}}</li>
                 <li>{{__('get referral code from us')}}</li>
                 <li>{{__('belong to an association that is affiliated with us')}}</li>

             </ul>
         </div>

         <div class="col-md-5 mt-5 pb-5">  <br><br>

          <img class="image_home_page" style="border-radius:10px;" src="{{ asset('images/pexels-fauxels-3182812.jpg') }}" width=420; height="440"      alt="Generic placeholder image">
         </div>
       </div> --}}

        <!-- <p style="padding:60px;"> </p> -->


       <!-- /END THE FEATURETTES -->

      <br><br>
       <p class="text-center site_topics">{{__('frequently asked questions')}}</h1>

         <br>

          <p class="featurette-heading page_topics">{{__('In what countries does Dohzy operate')}} ?</p>
          <p> <span style="color:#000000; font-weight:bolder; font-size:16px;"> {{__('Canada')}} </span> </p>
          <br>

          <p class="featurette-heading page_topics">{{__('what is the diaspora')}} ?</p>
          <p> <span style="color:#000000; font-weight:bolder; font-size:16px;"> {{__('the diaspora is people that have settled in a country that is not their ancestral homeland. They usually still have ties to their country of origin through family or culture')}} </span> </p>
          <br>

          <p class="featurette-heading page_topics">{{__('do i have to be part of the african diaspora to use a dohzy service')}} ?</p>
          <p> <span style="color:#000000; font-weight:bolder; font-size:16px;"> {{__('no you do not have to be part of the diaspora to use our services. We are open to everyone in canada')}} </span> </p>




     </div><!-- /.container -->

           <!--
            <div class="container-fluid mt-3" style="background-color:#e9ecef;">

                <div class="container">

                <h2  style="color:#312A5C; padding-top:45px;">Are You In A Difficult Cash Flow Situation ?</h2>

               <div class="row">
                <div class="col-md-8">
                <p class="mt-3 lead">We can help you. Our state of the art platform will rapidly process your request for funds
                    and within a matter of hours funds could be provided to help fix your issue and relieve you off stress
                </p>
                </div>
                <div class="col-md-2">
                 <p class="float-right mt-4"><a class="btn btn-lg btn-primary slide_buttons" href="{{route('user.register')}}" role="button">Join Today</a></p>

                </div>
               </div>

                <br><br>

                </div>

            </div>
            -->




           {{--
            <h1 class="text-center" style="margin-top:20px; padding-bottom:50px; font-weight:900; color:#312A5C;">Our Partners<!-- <span class="text-muted">See for yourself.</span>--></h1>

            <div class="row">

              <div class="col-md-3">
                  <a href="{{route('user.register')}}" style="text-decoration: none;">
                  <div class="text-center"> <img  src="{{ asset('images/desjardins-logo.jpeg') }}" alt="Generic placeholder image" width="150" height="150"></div>
                  </a>
              </div><!-- /.col-lg-4 -->

              <div class="col-md-3">
                  <a href="{{route('funds-apply.create')}}" style="text-decoration: none;">
                  <div class="text-center"> <img  src="{{ asset('images/cibc-logo.png') }}" alt="Generic placeholder image" width="150" height="150"> </div>
                  </a>
              </div><!-- /.col-lg-4 -->

              <div class="col-md-3">
                  <a href="{{route('user-dashboard')}}" style="text-decoration: none;">
                  <div class="text-center"> <img  src="{{ asset('images/td-logo.png') }}" alt="Generic placeholder image" width="150" height="150"> </div>
                  </a>
              </div><!-- /.col-lg-4 -->


            <div class="col-md-3">
              <a href="{{route('user-dashboard')}}" style="text-decoration: none;">
              <div class="text-center"> <img  src="{{ asset('images/rbc-logo.png') }}" alt="Generic placeholder image" width="150" height="150"> </div>
              </a>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->

        --}}

   </main> <br><br><br><br><br><br><br><br><br><br>



@endsection

<!--page specific scripts -->
@section('scripts')
 <script>
  console.log('Hello world. this is a page specific script');
 </script>
@endsection
