@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')
    @inject('loanMetric', 'App\Services\LoanService')
    @inject('user', 'App\Models\User')

     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for loan')}} </h3>
            <hr>

            <div class="container mt-5 mb-4">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('you need a')}}<strong> {{__('referral code')}}</strong> {{__('to apply for a loan')}}. {{__('if you do not have one please')}} <a href="{{ route('user.show-generate-referral-code') }}"><u style="color:#5f5fd4">{{__('request a referral code')}}</u></a></p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('your loan range is')}} : <strong><span style="font-weight: 900; color:#312A5C;">${{$loanMetric->getLoanRange($user->getUserId())[0]}} - ${{$loanMetric->getLoanRange($user->getUserId())[1]}} </span></strong> </p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('after completely repaying a loan, you have to wait for')}} <strong><span style="font-weight: 900; color:#312A5C;"> <u>{{$loanMetric->getWaitPeriodBetweenLoans($user->getUserId())}} {{__('days')}}</u> </span></strong> {{__('before applying another loan')}} </p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} :  <strong><span style="font-weight: 900; color:#312A5C;">{{__('interac etransfer')}}</span></strong></p>
                    </div>
                </div>
            </div>

            <div class="container" onload="loansFormLoaded()" >

                <form method="post" action="{{route('funds-apply.store')}}" id="loan_apply_form" >
                    @csrf

                  <div class="form-row">

                      <div class="form-group col-md-6 mt-5">
                          <label class="form_text">{{__('referral code')}}
                              <a href="#" data-toggle="modal" data-target="#myModal" > <i class="fas fa-question-circle explainer_icon_style"></i> </a>

                              @include('explainers.referral-code-explainer')
                          </label>
                          <input type="text" name="referralCode" class="form-control {{ $errors->has('referralCode') ? ' is-invalid' : '' }}"
                                 value={{old('referralCode',$metrics->referral_code)}} >

                          @if ($errors->has('referralCode'))
                              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('referralCode') }}</strong>
                           </span>
                          @endif

                      </div>

                    <div class="col-md-6 mt-5">
                      <label class="form_text">{{__('amount requested')}}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$CAD</span>
                            </div>

                        <select id="request_amount"  name="amountRequested"  class="form-control">
                            @foreach($possibleLoanAmounts as $amount)
                                <option   value={{$amount}} {{ old('amountRequested')==$amount ? 'selected' :'' }}>{{$amount}}</option>
                            @endforeach
                        </select>
                        {{--
                        <small><i class="fas fa-info-circle"></i> {{__('this amount will increase if you use the system properly')}}</small> --}}

                        @if ($errors->has('amountRequested'))
                            <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('amountRequested') }}</strong>
                           </span>
                        @endif
                     </div>
                    </div>

                      <div class="col-md-6 mt-5">

                          <label class="form_text" >{{__('when will you like to receive money from us')}} </label>

                          <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                          </div>

                          <input type="text" data-date-format="yyyy-mm-dd"  name="receiveMoneyDate" id="datepickerGetMoneyDate"
                                 value="{{old('receiveMoneyDate')}}"

                                 class="form-control {{ $errors->has('receiveMoneyDate') ? ' is-invalid' : '' }}" />

                          @if ($errors->has('receiveMoneyDate'))
                              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('receiveMoneyDate') }}</strong>
                           </span>
                          @endif
                      </div>
                      </div>

                       {{--
                      <div class="col-md-6 mt-4">
                      <label class="form_text">{{__('when can you pay back')}} </label>
                      <div class="input-group">
                          <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBackRef" name="payBackDate"
                      <div class="input-group"> <!--
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                          </div> -->

                          <input type="text" data-date-format="yyyy-mm-dd"  id="datepickerPayBackRef" name="payBackDate"
                                 value="{{old('payBackDate')}}"
                                 class="form-control {{ $errors->has('payBackDate') ? ' is-invalid' : '' }}" />

                          @if ($errors->has('payBackDate'))
                              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payBackDate') }}</strong>
                           </span>
                          @endif
                      </div>
                      </div> --}}

                      {{--
                      <div class="form-group col-md-6">
                          <label>How do you want to receive your interac</label>

                          <div class="form-check">
                              <input class="form-check-input {{ $errors->has('referralMoneyReceiveMeans') ? ' is-invalid' : '' }}" type="radio" name="referralMoneyReceiveMeans" id="exampleRadios1"
                                     value="email" {{ old('referralMoneyReceiveMeans')=="email" ?'checked':''}}  checked>
                              <label class="form-check-label" for="exampleRadios1">Email </label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input {{ $errors->has('referralMoneyReceiveMeans') ? ' is-invalid' : '' }}" type="radio" name="referralMoneyReceiveMeans" id="exampleRadios2"
                                     value="phone" {{ old('referralMoneyReceiveMeans')=="phone" ?'checked':''}} >
                              <label class="form-check-label" for="exampleRadios2">Phone</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input {{ $errors->has('referralMoneyReceiveMeans') ? ' is-invalid' : '' }}" type="radio" name="referralMoneyReceiveMeans" id="exampleRadios2"
                                     value="email-phone" {{ old('referralMoneyReceiveMeans')=="email-phone" ?'checked':''}} >
                              <label class="form-check-label" for="exampleRadios2">Phone and Email</label>
                              @if ($errors->has('referralMoneyReceiveMeans'))
                                  <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('referralMoneyReceiveMeans') }}</strong>
                                 </span>
                              @endif
                          </div>

                      </div>
                      --}}

                      <div class="form-group col-md-6 mt-5">
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

                      {{--
                      <div class="form-group col-md-6 mt-4">
                          <label class="form_text mt-2"> {{__('do you have auto deposit enabled')}} </label>

                          <div class="form-check ml-3">
                              <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                     type="radio" name="autoDepositEnabled"
                                     value="1" {{ old('autoDepositEnabled')=="1" ?'checked':''}} >
                              <label class="form-check-label" for="exampleRadios1">{{__('yes')}} </label>
                          </div>

                          <div class="form-check ml-3">
                              <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                     type="radio" name="autoDepositEnabled"
                                     value="0" {{ old('autoDepositEnabled')=="0" ?'checked':''}} >
                              <label class="form-check-label" for="exampleRadios2">{{__('no')}}</label>

                              @if ($errors->has('autoDepositEnabled'))
                                  <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('autoDepositEnabled') }}</strong>
                            </span>
                              @endif

                          </div>


                      </div> --}}


                </div>

                    <button type="submit" id="loanApply" class="btn btn-success mt-5 mb-5 buttons_style">
                         {{__('next step')}} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

   @include('notes.personal-loan-notes')



    </div>


@endsection


@section('scripts')
    <script>

        // set default dates
        var start = new Date();  // date of today


        //var nextDay = start.setDate(start.getDate() + 1);

        //set end date of 2 months from now
        var end = new Date(new Date().setMonth(start.getMonth()+1)); // 2 months from today

        //date picker for payback date
        $('#datepickerPayBackRef').datepicker({
            weekStart: 1,
            //daysOfWeekHighlighted: "6,0",
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
            //daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: false,
            startDate : '+1d',
            endDate   : end
        });
        $('#datepickerGetMoneyDate').datepicker();
        //to load current date in date input field use
        //$('#datepickerGetMoneyDate').datepicker("setDate", new Date());


    </script>

{{-- check if session exist before displaying pop up. this is used to display pop just once(one page) load --}}
@if(!session()->has('loanModal'))
   <script>
	$(document).ready(function(){
		$("#myLoansInfoPopUp").modal('show');
	});
   </script>

{{ session()->put('loanModal','shown') }} {{--put value into session so that after pop displays once its not displayed again --}}

<div class="modal" id="myLoansInfoPopUp">
    <div class="modal-dialog">

        <div class="modal-content" style="background-color:#ffffff;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color:#312A5C;">{{__('about dohzy loans')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

             <!-- Modal body -->
            <div class="modal-body">
		     <ul>
                 <li class="mb-3">{{__('loans below 400 can repaid in one installment within a maximum time of one month')}}</li>
                 <li class="mb-3">{{__('loans between 400 and 700 could be repaid in two installments within a maximum time of 1 month')}}</li>
                 <li class="mb-3">{{__('loans between 700 to 1000 could be repaid in three installments within a maximum time of 2 months')}}</li>
                 <li class="mb-3">{{__('the final interest rate of a loan will be calculated and given at the end of the loan application process')}}</li>
             </ul>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger close_button_design" data-dismiss="modal">{{__('close')}}</button>
            </div>

        </div>
    </div>
</div>

@endif

@endsection
