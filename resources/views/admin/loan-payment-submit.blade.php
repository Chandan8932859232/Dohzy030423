@extends ('layouts.admin')

@section('title', 'Loan Payment Submission')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">Loan Repayment </h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> Submitting a payment will do the following</strong>
                    <ul><li>Update loan balance of the loan</li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="container">

                <form method="post" action="{{route('handle.loan-repayment')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Loan Id</label>
                            <input type="text"  name="loanId" value="{{old('loanId', $loanInfo->id)}}"

                                   class="form-control {{ $errors->has('loanId') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('loanId'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('loanId') }}</strong>
                           </span>
                            @endif

                        </div>


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Amount Paid ($CAD)  </label>
                            <input type="text"  name="amountPaid"
                                   value="{{old('amountPaid')}}"
                                   class="form-control {{ $errors->has('amountPaid') ? ' is-invalid' : '' }}" />

                                  @if ($errors->has('amountPaid'))
                                       <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('amountPaid') }}</strong>
                                       </span>
                                  @endif
                        </div>



                      <div class="form-group col-md-6 mt-4 ">
                        <label>Payment Method</label>
                        <select  name="paymentMethod" class="form-control {{ $errors->has('paymentMethod') ? ' is-invalid' : '' }}">
                            <option value="">{{__('please select')}}</option>
                            <option value="1" {{ old('paymentMethod')==1 ? 'selected' :''}}>interac etransfer</option>
                            <option value="2" {{ old('paymentMethod')==2 ? 'selected' :''}}>automatic bank withdrawal</option>
                            <option value="3" {{ old('paymentMethod')==3 ? 'selected' :''}}>PayPal</option>
                        </select>
                        @if($errors->has('paymentMethod'))
                            <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('paymentMethod') }}</strong>
                                      </span>
                        @endif
                    </div>



                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Payment Date</label>
                            <input type="text"  name="paymentDate" data-date-format="yyyy-mm-dd" id="datepickerPaymentDate"
                                   value="{{old('paymentDate')}}"
                                   class="form-control {{ $errors->has('paymentDate') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('paymentDate'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('paymentDate') }}</strong>
                               </span>
                            @endif

                        </div>



                        <button type="submit" class="btn btn-dark btn-block mt-4 mb-5 ">
                            Make Payment
                        </button>
                </form>
            </div>
        </div>






    </div>


@endsection






@section('scripts')
    <script>


        //date picker for payback date
        $('#datepickerPaymentDate').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepickerPaymentDate').datepicker();
        //to load current date in date input field use
          $('#datepickerPaymentDate').datepicker("setDate", new Date());



    </script>
@endsection




