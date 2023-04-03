@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : {{__('repayment date')}}</h3>
            <hr>


            <div class="container mt-5 mb-2">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                        <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be automatically withdrawn from your account on the selected dates')}} </p>
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('please note that Mondays, Saturdays and Sundays are not acceptable repayment dates')}} </p>
                     {{-- <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('to increase your chance of approval please select a date within a month')}}</p>--}}
                    </div>
                </div>
            </div>


            <div class="container">

                <form method="post" action="{{route('no-installment-loan.handle')}}" >
                    @csrf

                  <div class="form-row">



                    <div class="col-md-12 mt-4 no_installment_payback_date">
                        <label class="form_text">{{__('when can you pay back')}} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                            </div>
                            <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBack" name="payBackDate"
                                   value="{{old('payBackDate')}}"
                                   class="form-control {{ $errors->has('payBackDate') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('payBackDate'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('payBackDate') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>



                </div>

                     <br><br><br>
                    <a type="button" href="{{route('funds-apply.create')}}"
                        class="btn btn-outline-dark float-left">
                        <i class="fas fa-arrow-left"></i>  {{__('back')}}
                     </a>


                     <button type="submit"  class="btn btn-primary float-right buttons_style">
                        {{__('next step')}} <i class="fas fa-arrow-right"></i>
                      </button>

                </form>
            </div>
        </div>

   {{--@include('notes.loan-apply-notes')--}}



    </div>   <br><br><br><br><br><br><br>


@endsection




@section('scripts')

@if(session('amountRequested')  <= 700 )

  <script>
    var start = new Date();  // date of today
    //set end date of 1 months from now
    var end = new Date(new Date().setMonth(start.getMonth()+1)); // 1 months from today
  </script>

@endif


@if(session('amountRequested')  > 700 )

  <script>
    var start = new Date();  // date of today
    //set end date of 1 months from now
    var end = new Date(new Date().setMonth(start.getMonth()+2)); // 2 months from today
  </script>

@endif


 <script>
     //date picker for payback date
     $('#datepickerPayBack').datepicker({
        weekStart: 1,
        daysOfWeekDisabled: [0, 1, 6],
        //daysOfWeekHighlighted: "6,0",
        autoclose: true,
        //todayHighlight: true,
        startDate : start,
        endDate   : end
        });
    $('#datepickerPayBack').datepicker();
    //to load current date in date input field use
    //$('#datepickerPayBack').datepicker("setDate", new Date());
 </script>



@endsection
