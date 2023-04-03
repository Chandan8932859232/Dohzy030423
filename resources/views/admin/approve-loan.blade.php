@extends ('layouts.admin')

@section('title', 'Approve Loan')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">{{__('approve loan')}} </h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> Approving This Loan will Do The Following</strong>
                      <ul>
                          <li>Send an approval email to the user</li>
                          <li> Send an approval text message to the user</li>
                          <li> Change the state of the loan to awaiting user approval </li>
                </div>
            </div>
            <hr>

            <div class="container">

                <form method="post" action="{{route('admin.send-loan-approval')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Loan Id</label>
                            <input type="text"  name="loanId"
                                   value="{{old('loanId', $loanInfo->id)}}"
                                   class="form-control {{ $errors->has('requestAmount') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('loanId'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('loanId') }}</strong>
                           </span>
                            @endif

                        </div>


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('amount requested')}}($CAD)</label>
                            <input type="text"  name="requestAmount"
                                   value="{{old('requestAmount', $loanInfo->application_amount)}}"
                                   class="form-control {{ $errors->has('requestAmount') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('requestAmount'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('requestAmount') }}</strong>
                           </span>
                            @endif

                        </div>

                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('approved amount')}}($CAD)  </label>
                            <input type="text"  name="amountApproved"
                                   value="{{old('amountApproved', $loanInfo->application_amount)}}"
                                   class="form-control {{ $errors->has('amountApproved') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('amountApproved'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('amountApproved') }}</strong>
                           </span>
                            @endif

                        </div>

                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('interest rate')}} (%) </label>
                            <input type="text"  name="interestRate"
                                   value="{{old('interestRate', $loanInfo->interest_rate)}}"
                                   class="form-control {{ $errors->has('interestRate') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('interestRate'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('interestRate') }}</strong>
                           </span>
                            @endif

                        </div>



                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('payback amount')}} ($CAD) </label>
                            <input type="text"  name="payBackAmount"
                                   value="{{old('payBackAmount', $loanInfo->balance)}}"
                                   class="form-control {{ $errors->has('payBackAmount') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('payBackAmount'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payBackAmount') }}</strong>
                           </span>
                            @endif

                        </div>



                        <div class="col-md-6 mt-4">
                            <label class="form_text" >{{__('when money will be sent')}} </label>

                            <div class="input-group"> {{--
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                          </div> --}}

                                <input type="text" data-date-format="yyyy-mm-dd"  name="sendMoneyDate" id="datepickerSendMoneyDate"
                                       value="{{old('sendMoneyDate', $loanInfo->application_receive_money_date)}}"

                                       class="form-control {{ $errors->has('sendMoneyDate') ? ' is-invalid' : '' }}" />

                                @if ($errors->has('sendMoneyDate'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sendMoneyDate') }}</strong>
                           </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">{{__('by what time will money be sent')}}  </label>

                            <input type="time"  name="sendMoneyTime"
                                   value="{{old('sendMoneyTime')}}"
                                   class="form-control {{ $errors->has('sendMoneyTime') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('sendMoneyTime'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sendMoneyTime') }}</strong>
                           </span>
                            @endif

                        </div>

                        <br>

                    <button type="submit" class="btn btn-dark btn-block mt-3 mb-5 ">
                        <i class="far fa-paper-plane"></i> {{__('approve loan')}}
                    </button>
                </form>
            </div>
        </div>






    </div>


@endsection


@section('scripts')
    <script>


        //date picker for payback date
        $('#datepickerSendMoneyDate').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepickerSendMoneyDate').datepicker();
        //to load current date in date input field use
         // $('#datepickerSendMoneyDate').datepicker("setDate", new Date());



    </script>
@endsection
