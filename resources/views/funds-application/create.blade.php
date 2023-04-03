@extends ('layouts.user')

@section('title', 'Apply for a loan')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center mt-3 form_title">Apply For Funds - Group member application</h3> <hr>
            <div>

                <form method="POST"  action="{{ route('applications.store')}}">
                    @csrf

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="amount">Amount Requested <a class="text-danger">*</a></label>
                        <select id="inputState"  name="applicationAmount"
                                class="form-control {{ $errors->has('applicationAmount') ? ' is-invalid' : '' }}">

                            @foreach($possibleLoanAmounts as $amount)
                              <option   value={{$amount}} {{ old('applicationAmount')==$amount ? 'selected' :'' }}>${{$amount}}</option>
                            @endforeach

                        </select>

                        @if ($errors->has('applicationAmount'))
                            <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('applicationAmount') }}</strong>
                           </span>
                        @endif
                   </div>

                    <div class="form-group col-md-6">
                        <label for="group">Savings Group</label>
                        <select id="inputState"  name="applicantGroupName"  value="{{ old('applicantGroupName') }}"
                                class="form-control {{ $errors->has('applicantGroupName') ? ' is-invalid' : '' }}">
                            <option>Choose Group</option>
                            <option>Soba Montreal</option>
                            <option>Lecda Montreal </option>
                            <option>Other </option>
                        </select>

                        @if ($errors->has('applicantGroupName'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('applicantGroupName') }}</strong>
                           </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="group-admin-name">Group's Admin Name <a class="text-danger">*</a></label>
                        <input type="text"  name="applicantGroupAdminName" value="{{ old('applicantGroupAdminName') }}"
                               class="form-control {{ $errors->has('applicantGroupAdminName') ? ' is-invalid' : '' }}" />

                        @if ($errors->has('applicantGroupAdminName'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('applicantGroupAdminName') }}</strong>
                           </span>
                        @endif

                    </div>


                      <div class="form-group col-md-6">
                          <label for="pay-back-time">When do you want to receive money from us <a class="text-danger">*</a> </label>

                          <input type="text"  data-date-format="dd/mm/yyyy" id="datepickerMoneyGet" value="{{ old('applicationPayBackDate') }}"
                                 name="moneyRecieveDate"  class="form-control {{ $errors->has('applicationPayBackDate') ? ' is-invalid' : '' }}"/>

                          @if ($errors->has('applicationPayBackDate'))
                              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('applicationPayBackDate') }}</strong>
                           </span>
                          @endif
                      </div>


                    <div class="form-group col-md-6">
                        <label for="pay-back-time">When can you pay back <a class="text-danger">*</a> </label>

                        <input type="text"  data-date-format="dd/mm/yyyy" id="datepickerPayBack" value="{{ old('applicationPayBackDate') }}"
                               name="applicationPayBackDate"  class="form-control {{ $errors->has('applicationPayBackDate') ? ' is-invalid' : '' }}"/>

                        @if ($errors->has('applicationPayBackDate'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('applicationPayBackDate') }}</strong>
                           </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="get-group-money">When would you get money from group <a class="text-danger">*</a> </label>
                        <input type="text" class="form-control {{ $errors->has('applicantGroupMoneyReceiveDate') ? ' is-invalid' : '' }}" data-date-format="dd/mm/yyyy" id="datepickerReceiveGroupMoney"
                               name="applicantGroupMoneyReceiveDate" value="{{ old('applicantGroupMoneyReceiveDate') }}"/>

                        @if ($errors->has('applicantGroupMoneyReceiveDate'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('applicantGroupMoneyReceiveDate') }}</strong>
                           </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                      <label for="country">How do you want to receive your interac eTransfer</label>
                        <select id="inputState"  name="applicationMoneyReceiveMeans"  class="form-control">
                            <option value="email">email</option>
                            <option value="phone">phone</option>
                            <option value="email-phone">phone and email</option>
                        </select>
                    </div>

                     <div>
                      <label for=" " class="mt-2"> Do you have autodeposit enabled </label>

                      <div class="form-check">
                          <input class="form-check-input {{ $errors->has('applicantAutoDepositEnabled') ? ' is-invalid' : '' }}" type="radio" name="applicantAutoDepositEnabled" id="exampleRadios1"  value= "yes" {{ old('applicantAutoDepositEnabled')=="yes" ?'checked':''}}  >
                          <label class="form-check-label" for="exampleRadios1">Yes </label>
                      </div>

                      <div class="form-check">
                          <input class="form-check-input {{ $errors->has('applicantAutoDepositEnabled') ? ' is-invalid' : '' }}" type="radio" name="applicantAutoDepositEnabled" id="exampleRadios2" value= "no" {{ old('applicantAutoDepositEnabled')=="no" ?'checked':''}} >
                          <label class="form-check-label" for="exampleRadios2">No</label>
                          @if ($errors->has('applicantAutoDepositEnabled'))
                              <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('applicantAutoDepositEnabled') }}</strong>
                            </span>
                          @endif
                      </div>

                     </div>

                </div>

                    <a href="{{ route('application.choose')}}" class="btn  btn-info pull-left mt-2 text-white buttons_style"> <i class="fas fa-arrow-left"></i> Previous Step </a>

                   <!-- <a href="{{ route('applications.store')}}" type="submit"  class="btn  btn-info pull-right mt-2"> <i class="fas fa-arrow-right"></i> Next Step</a> -->

                    <button type="submit" class="btn btn-info mt-2 text-white buttons_style">Next Step <i class="fas fa-arrow-right"></i></button>



                </form>
            </div>
        </div>



        <div class="col-sm-4 mt-5">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Please Note the following</strong></li>
                <li class="list-group-item">It takes about 12hours to get </li>
                <li class="list-group-item">Third item</li>
                <li class="list-group-item">Fourth item</li>
            </ul>

        </div>



    </div>


@endsection

<!--page specific scripts (script for datepicker) -->
@section('scripts')
    <script>
         //date picker for payback date
        $('#datepickerPayBack').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepickerPayBack').datepicker();
        //to load current date in date input field use
           //$('#datepickerPayBack').datepicker("setDate", new Date());

         //date picker for date to recieve money from group
         $('#datepickerReceiveGroupMoney').datepicker({
             weekStart: 1,
             daysOfWeekHighlighted: "6,0",
             autoclose: true,
             todayHighlight: true,
         });
         $('#datepickerReceiveGroupMoney').datepicker();

         //date picker for date to recieve money from us(dohzy)
         $('#datepickerMoneyGet').datepicker({
             weekStart: 1,
             daysOfWeekHighlighted: "6,0",
             autoclose: true,
             todayHighlight: true,
         });
         $('#datepickerMoneyGet').datepicker();

    </script>
@endsection
