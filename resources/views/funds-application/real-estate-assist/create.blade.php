@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')

    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')

    <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('real estate assistance loan')}} </h3>
            <hr>

            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('you need a')}}<strong> {{__('referral code')}}</strong> {{__('to apply for a loan')}}. {{__('if you do not have one please')}} <a href="{{route('request.referral-code')}}"><u style="color:#5f5fd4">{{__('request a referral code')}}</u></a></p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></p>
                    </div>
                </div>
            </div>

            <div class="container">

                <form method="post" action="{{route('real-estate-form.process')}}">
                    @csrf

                    <div class="form-row">


                    <div class="form-group col-md-6 mt-4">
                          <label class="form_text">{{__('referral code')}}
                              <a href="#" data-toggle="modal" data-target="#myModal" > <i class="fas fa-question-circle explainer_icon_style"></i> </a>

                              @include('explainers.referral-code-explainer')
                          </label>
                          <input type="text" name="referralCode" class="form-control {{ $errors->has('referralCode') ? ' is-invalid' : '' }}"
                                 value={{old('referralCode',$metrics->referral_code)}}>

                          @if ($errors->has('referralCode'))
                              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('referralCode') }}</strong>
                           </span>
                          @endif
                      </div>


                        <div class="col-md-6 mt-4">
                            <label class="form_text">{{__('amount requested')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$CAD</span>
                                </div>

                                <select id="inputState"  name="amountRequested"  class="form-control">
                                    @foreach($possibleRealEstateAmounts as $amount)
                                        <option   value={{$amount}} {{ old('amountRequested')==$amount ? 'selected' :'' }}>{{$amount}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('amountRequested'))
                                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('amountRequested') }}</strong>
                           </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form_text" >{{__('when will you like to receive money from us')}} </label>

                            <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                          </div>

                                <input type="text" data-date-format="yyyy-mm-dd"  name="receiveMoneyDate" id="datepickerGetMoneyDate"
                                       value="{{old('receiveMoneyDate')}}" {{--
                                 onclick="return alert('Please Note The Following  \n\n' +

                                   ' - If you select that you want to receive money today you will get the funds within 24 hours of application \n\n' +
                                   ' - If you select that you want to receive money at least 24hours from today, you will get on the exact date \n'

                                  );" --}}

                                       class="form-control {{ $errors->has('receiveMoneyDate') ? ' is-invalid' : '' }}" />

                                @if ($errors->has('receiveMoneyDate'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('receiveMoneyDate') }}</strong>
                           </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form_text">{{__('when can you pay back')}} </label>
                            <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                          </div>

                                <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBackRef" name="payBackDate"
                                       value="{{old('payBackDate')}}"
                                       class="form-control {{ $errors->has('payBackDate') ? ' is-invalid' : '' }}" />

                                @if ($errors->has('payBackDate'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payBackDate') }}</strong>
                           </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group col-md-6 mt-4">
                            @php
                                $userEmail = Auth::user()->email; //email that used to create account and login
                            @endphp

                            <label class="form_text">{{__('email address for')}} {{__('interac etransfer')}}  </label>
                            <input type="email"  name="interactEmail"
                                   value="{{old('interactEmail', $userEmail)}}"
                                   class="form-control {{ $errors->has('interactEmail') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('interactEmail'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('interactEmail') }}</strong>
                           </span>
                            @endif

                        </div>


                    </div>


                 <a type="button" href="{{route('real-estate-prove')}}"
                    class="btn btn-outline-dark mt-5 float-left">
                    <i class="fas fa-arrow-left"></i>  {{__('back')}}
                </a>

              <button type="submit" class="btn btn-primary mt-5 float-right buttons_style">
                 {{__('next step')}} <i class="fas fa-arrow-right"></i>
               </button>


                </form>
            </div>
        </div>


         @include('notes.real-estate-loan-notes')



    </div>


@endsection


@section('scripts')
    <script>


              // set default dates
       var start = new Date(); // date of today

       //set end date of 2 months from now
       var end = new Date(new Date().setMonth(start.getMonth()+5)); // 5 months from today

        //date picker for payback date
        $('#datepickerPayBackRef').datepicker({
            weekStart: 1,
           // daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,

            startDate : start,
            endDate   : end
        });
        $('#datepickerPayBackRef').datepicker();
        //to load current date in date input field use
        //$('#datepickerPayBack').datepicker("setDate", new Date());


        //date picker for payback date
        $('#datepickerGetMoneyDate').datepicker({
            weekStart: 1,
           // daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
            startDate : '+1d',
            endDate   : end
        });
        $('#datepickerGetMoneyDate').datepicker();
        //to load current date in date input field use
        //$('#datepickerPayBack').datepicker("setDate", new Date());


    </script>
@endsection
