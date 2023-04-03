@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h2 class="text-center mt-3 form_title">{{__('apply for a loan')}} : {{__('payment dates')}} </h2>
            <hr>

            <div class="container mt-5 mb-2">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be automatically withdrawn from your account on the selected dates')}} </p>
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('please note that Mondays, Saturdays and Sundays are not acceptable repayment dates')}} </p>
                    </div>
                </div>
            </div>

            <div class="container">

                <form method="post" action="{{route('two-installment-loan.handle')}}" >
                    @csrf

                  <div class="form-row">

                      <div class="col-md-12 mt-4 installment_payback_date">
                        <label class="form_text">{{__('first installment payback date')}}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" data-date-format="yyyy-mm-dd" id="datepickerFirstInstallment" name="firstInstallmentPayBackDate"
                                   value="{{old('firstInstallmentPayBackDate')}}"
                                   class="form-control {{ $errors->has('firstInstallmentPayBackDate') ? ' is-invalid' : '' }}" />

                            @if($errors->has('firstInstallmentPayBackDate'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('firstInstallmentPayBackDate') }}</strong>
                             </span>
                            @endif
                        </div>
                        </div>


                                <div class="col-md-12 mt-5 installment_payback_date">
                                    <label class="form_text">{{__('second installment payback date')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" data-date-format="yyyy-mm-dd" id="datepickerSecondInstallment" name="secondInstallmentPayBackDate"
                                               value="{{old('secondInstallmentPayBackDate')}}"
                                               class="form-control {{ $errors->has('secondInstallmentPayBackDate') ? ' is-invalid' : '' }}" />

                                        @if ($errors->has('secondInstallmentPayBackDate'))
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('secondInstallmentPayBackDate') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>


                </div>

                    <br><br><br>

                    <a type="button" href="{{route('installment-refund.option')}}"
                        class="btn btn-outline-dark float-left">
                        <i class="fas fa-arrow-left"></i>  {{__('back')}}
                     </a>

                        <button type="submit" class="btn btn-primary float-right buttons_style">
                          {{__('next step')}} <i class="fas fa-arrow-right"></i>
                        </button>
                </form>
            </div>
        </div>

   {{--@include('notes.loan-apply-notes')--}}



    </div>


@endsection


@section('scripts')


@if(session('amountRequested')  > 399 && session('amountRequested')  <= 700 )
  <script>

function addDays(date, days) {
  const copy = new Date(Number(date))
  copy.setDate(date.getDate() + days)
  return copy
}

    var start = new Date();  // date of today

    //set end date of 1 months from now
    var end_1 = new Date(new Date().setMonth(start.getMonth()+1)); // 1 months from today

    var end = addDays(end_1, 20); // add 15 days to 1 month to make 1.5 month

  </script>
@endif


@if(session('amountRequested')  > 700 )
  <script>
    var start = new Date();  // date of today
    //set end date of 2 months from now
    var end = new Date(new Date().setMonth(start.getMonth()+2)); // 2 months from today
  </script>
@endif


 <script>
 //date picker for payback date
 $('#datepickerFirstInstallment').datepicker({
    weekStart: 1,
    daysOfWeekDisabled: [0,1, 6],
    //daysOfWeekHighlighted: "6,0",
    autoclose: true,
    //todayHighlight: true,
    startDate : start,
    endDate   : end
    });
$('#datepickerFirstInstallment').datepicker();
//to load current date in date input field use
//$('#datepickerFirstInstallment').datepicker("setDate", new Date());


 //date picker for payback date
 $('#datepickerSecondInstallment').datepicker({
    weekStart: 1,
    daysOfWeekDisabled: [0, 1, 6],
    //daysOfWeekHighlighted: "6,0",
    autoclose: true,
   // todayHighlight: true,
    startDate : start,
    endDate   : end
    });
$('#datepickerSecondInstallment').datepicker();
//to load current date in date input field use
//$('#datepickerFirstInstallment').datepicker("setDate", new Date());
 </script>


@endsection
