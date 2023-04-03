@extends ('layouts.user')

@section('title', 'Edit Loan')

@section('content')


    @inject('loan', 'App\Services\ApplyForFundsService')


    <div class="row mt-3">


        <div class="col-sm-8 offset-sm-0">
            <h3 class="text-center form_title">{{__('edit loan application')}}</h3>
            <hr class="form_line">

            <form method="POST" action="{{route('user-application.update', $loanRequest->id)}}">
                @method('PUT')
                @csrf

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label class="form_text">{{__('referral code')}}</label>
                        <input type="text" name="referralCode" class="form-control {{ $errors->has('referralCode') ? ' is-invalid' : '' }}"
                               value="{{ old('referralCode',$loanRequest->application_referral_code)}}" />

                        @if ($errors->has('referralCode'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('referralCode') }}</strong>
                           </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6">
                        <label class="form_text">{{__('amount requested')}}</label>
                        <select id="inputState"  name="amountRequested"  class="form-control">

                            @foreach($loan->getPossibleLoanAmounts($loanRequest->applicant_user_id) as $amount)
                                <option   value={{$amount}} {{ old('amountRequested',$loanRequest->application_amount)==$amount ? 'selected' :'' }}>${{$amount}}</option>
                            @endforeach

                        </select>
                        @if ($errors->has('amountRequested'))
                            <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('amountRequested') }}</strong>
                           </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form_text" >{{__('when will you like to receive money from us')}}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                            </div>

                            <input type="text" data-date-format="yyyy-mm-dd" id="datepickerGetMoneyDate" name="receiveMoneyDate"
                                   value="{{old('receiveMoneyDate',$loanRequest->application_receive_money_date)}}"
                                   onclick="return alert('Please Note The Following  \n\n' +

                                   ' - If you select that you want to receive money today you will get the funds within 24 hours of application \n\n' +
                                   ' - If you select that you want to receive money at least 24hours from today, you will get on the exact date \n'

                                  );"

                                   class="form-control {{ $errors->has('receiveMoneyDate') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('receiveMoneyDate'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('receiveMoneyDate') }}</strong>
                           </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form_text">{{__('when can you pay back')}} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                            </div>

                            <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBackRef" name="payBackDate"
                                   value="{{old('payBackDate',$loanRequest->application_receive_money_date)}}"
                                   onclick="return alert('In order to increase your chances of approval we recommend a date' +
                                   ' within a month'

                                  );"
                                   class="form-control {{ $errors->has('payBackDate') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('payBackDate'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payBackDate') }}</strong>
                           </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-md-6 mt-3">

                        <label class="form_text">{{__('email address for')}} {{__('interac etransfer')}}  </label>
                        <input type="email"  name="interactEmail" value="{{ old('interactEmail',$loanRequest->application_interact_email)}}"
                               class="form-control {{ $errors->has('interactEmail') ? ' is-invalid' : '' }}" />

                        @if ($errors->has('interactEmail'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('interactEmail') }}</strong>
                           </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6 mt-3">
                        <label class="form_text mt-2"> {{__('do you have auto deposit enabled')}} </label>

                        <div class="form-check ml-3">
                            <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                   type="radio" name="autoDepositEnabled"
                                   value="1" {{ old('autoDepositEnabled', $loanRequest->application_interact_autodeposit)==1 ?'checked':''}} >
                            <label class="form-check-label" for="exampleRadios1">{{__('yes')}} </label>
                        </div>

                        <div class="form-check ml-3">
                            <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                   type="radio" name="autoDepositEnabled"
                                   value="0" {{ old('autoDepositEnabled', $loanRequest->application_interact_autodeposit)==0 ?'checked':''}} >
                            <label class="form-check-label" for="exampleRadios2">{{__('no')}} </label>

                            @if ($errors->has('autoDepositEnabled'))
                                <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('autoDepositEnabled') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-success btn-block mt-2  buttons_style">
                    <i class="far fa-paper-plane"></i> {{__('edit loan application')}}
                </button>
            </form>

        </div>


        @include('notes.loan-edit-notes')



    </div>

@endsection

@section('scripts')

    @include('js-snippets.date-picker')

@endsection
