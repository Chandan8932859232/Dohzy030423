@extends ('layouts.guest')

@section('title', 'About us')

@section('content')

<style>
.about_us_header{
    background:linear-gradient( to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('{{asset('/images/about-us-desktop-dohzy.jpg')}}');
    background-repeat: no-repeat;
    background-size:100% 100%;
    height:350px;
}</style>
    {{-- background:url('{{asset('/images/about-us-desktop-dohzy.jpg')}}'); --}}


      <div class="jumbotron jumbotron-fluid about_us_header" >
          <p class="text-center text-white mt-5 static_page_topic" > {{__('about us')}} </p>
      </div>


        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row"> {{--
                <div class="col-lg-4">
                    <div class="text-center"> <img  src="{{ asset('images/create-account.png') }}" alt="Generic placeholder image" width="114" height="110"> </div>
                    <h3 class="steps mt-1">{{__('create account')}}</h3>
                    <p class="text-center lead">{{__('easily sign up')}}</p>
                    <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="text-center"> <img  src="{{ asset('images/apply-for-funds.png') }}" alt="Generic placeholder image" width="114" height="110"> </div>
                    <h3 class="steps mt-1">{{__('apply for funds')}}</h3>
                    <p class="text-center lead">{{__('apply for funds using referral')}}</p>
                    <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="text-center"> <img  src="{{ asset('images/receive-money.png') }}" alt="Generic placeholder image" width="114" height="110"> </div>
                    <h3 class="steps mt-1">{{__('receive funds')}}</h3>
                    <p class="text-center lead">{{__('receive money')}}<strong>{{__('twelve hours')}}</strong>{{__('after application through interac etransfer or paypal')}}</p>
                    <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
                </div><!-- /.col-lg-4 --> --}}
            </div><!-- /.row -->

            <!-- START THE FEATURETTES -->


         <br><br><br><br>
            <div class="row featurette">
                <div class="col-md-7 mt-3">
                    <h2 class="featurette-heading site_topics ">{{__('who are we')}}<!--<span class="text-muted">It'll blow your mind.</span> --></h2>
                    <p class="lead" style= "line-height: 2.0; text-align: justify;">
                    {{__('dohzy description')}}</p>
                </div>
                <div class="col-md-5">

                    <img class="featurette-image  img-fluid mx-auto mt-3"
                                 style="border-radius:10px; color:red;"
                                  src="{{ asset('images/dohzy-who-are-we.png') }}"   alt="Dohzy image about who we are">
                </div>
            </div>

            <br><br>
           {{-- <hr class="featurette-divider">--}}

            <br><br><br>

            <div class="row featurette">
                <div class="col-md-7 order-md-2 mt-4">
                    <h2 class="featurette-heading site_topics"> {{__('our mission')}}<!-- <span class="text-muted">See for yourself.</span>--></h2>
                    <p class="lead">
                    {{__('our intentions')}}
                    </p>

                    <ul class="lead advantages_list">
                        <li> {{__('level the playing field for everyone')}}</li>
                        <li> {{__('offer clients the push they need to make a financial jump')}}</li>
                        <li> {{__('assist our clients in every aspect of their financial journey')}}</li>
                        <li> {{__('provide financial education for those in need')}}</li>
                    </ul>

                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featurette-image img-fluid mx-auto" style="border-radius:10px;" src="{{ asset('images/5.jpg') }}"    alt="Dohzy mission image">
                </div>
            </div>

            <br><br>

            {{--<hr class="featurette-divider">--}}


            <div class="row featurette">
                <div class="col-md-7 mt-4">  <br><br>
                    <h2 class="featurette-heading site_topics"> {{__('our values')}} <!-- <span class="text-muted">Checkmate.</span>--></h2>
                    <p class="lead">{{__('we are very data centric and user a customer first approach in everything we do')}}</p>

                    <ul class="lead  advantages_list">
                        <li><span style="font-size: 18px; font-weight: 500;">{{__('customisation')}}</span> {{__('we offer financial services that fit your need, not a one size fits all')}} </li>

                        <li><span style="font-size: 18px; font-weight: 500;">{{__('appreciation')}}</span> {{__('you get instant rewards based on loyalty and how well you use our system')}} </li>

                        <li><span style="font-size: 18px; font-weight: 500;">{{__('honesty and transparency')}}</span>{{__('you will be able to see all of your data when you log into your account on our platform')}}</li>

                        <li><span style="font-size: 18px; font-weight: 500;">{{__('security')}}</span> {{__('your data is stored and protected with state of the art encryption algorithms')}}</li>

                    </ul>
                </div>
                <div class="col-md-5"> <br><br><br>
                    <img class="featurette-image img-fluid mx-auto" style="border-radius:10px;"  src="{{ asset('images/dohzy-values-pic.jpg') }}" alt="Dohzy values image">
                </div>
            </div>  <br><br>



            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->

      <!--
      <div class="jumbotron jumbotron-fluid mt-4">
          <div class="container">
              <h1 style="color:#685EA6;">{{__('are you in a difficult cash flow situation')}}</h1>


              <p class="lead">{{__('we can help you')}}
              </p>

              <p><a class="btn btn-lg btn-primary slide_buttons" href="{{route('funds-apply.create')}}" role="button">{{__('apply for funds')}}</a></p>

          </div>
      </div>
      -->




@endsection


