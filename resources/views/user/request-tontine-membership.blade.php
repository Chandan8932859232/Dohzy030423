@extends ('layouts.user')

@section('title', 'Request Savings Membership')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-0">

           <h3 class="text-center mt-3 form_title"> {{__('request tontine participation')}}</h3>


             <div class="container">

                <div class="card mt-5 mb-5 notes_style">
                        <div class="card-body">
                            <p class="ml-2 mt-3"> <span style='color:#312A5C; font-weight:bold;'>{{__('how it works')}} </span></p>
                            <p class="ml-3 mt-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('number of monthly contributions')}} : <span style='color:#312A5C; font-weight:bold;'>10</span></p>
                            <p class="ml-3 mt-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('monthly contribution deadline') }} : <span style='color:#312A5C; font-weight:bold;'>{{__('25th of every month')}} </span></p>
                            <p class="ml-3 mt-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('when it is your turn to receive funds, it will be sent on the')}} :<span style='color:#312A5C; font-weight:bold;'> {{__('5th of the month')}} </span></p>
                         </div>
                </div>
                        <form method="post" action="{{route('tontine-request.process')}}">
                            @csrf

                            <div class="form-row">

                                <div class="form-group mt-4  col-md-12">
                                    <label>{{__('how much would you like to contribute and receive')}}</label>
                                    <select  name="contributionPlan" class="form-control {{ $errors->has('contributionPlan') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>
                                        <option value="1" {{ old('contributionPlan')=="1" ?'selected':''}}>{{__('$100 monthly to receive $1,000')}}</option>
                                        <option value="2" {{ old('contributionPlan')=="2" ?'selected':''}}>{{__('$200 monthly to receive $2,000')}}</option>
                                        <option value="3" {{ old('contributionPlan')=="3" ?'selected':''}}>{{__('$300 monthly to receive $3,000')}}</option>
                                        <option value="4" {{ old('contributionPlan')=="4" ?'selected':''}}>{{__('$400 monthly to receive $4,000')}}</option>
                                        <option value="5" {{ old('contributionPlan')=="5" ?'selected':''}}>{{__('$500 monthly to receive $5,000')}}</option>
                                    </select>
                                    @if ($errors->has('contributionPlan'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('contributionPlan') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="col-md-12 mt-5">
                                    <label class="form_text">{{__('in what month do you want to start contributing')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" id="monthPickerContributionStartMonth" name="contributionStartMonth"
                                               value="{{old('contributionStartMonth')}}"
                                               class="form-control {{ $errors->has('contributionStartMonth') ? ' is-invalid' : '' }}" />

                                        @if($errors->has('contributionStartMonth'))
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('contributionStartMonth') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12 mt-5">
                                    <label class="form_text">{{__('in what month do you want to receive funds')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" id="monthPickerContributionReceiveMonth" name="contributionReceiveMonth"
                                               value="{{old('contributionReceiveMonth')}}"
                                               class="form-control {{ $errors->has('contributionReceiveMonth') ? ' is-invalid' : '' }}" />

                                        @if($errors->has('contributionReceiveMonth'))
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('contributionReceiveMonth') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group col-md-12 mt-5 ">
                                    <label>{{__('what are your objectives for the funds you will receive')}}</label>
                                    <select  name="participationPurpose" class="form-control {{ $errors->has('participationPurpose') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>
                                        <option value="travel" {{ old('participationPurpose')=="travel" ? 'selected' :''}}> {{__('vaccation expense')}}</option>
                                        <option value="vaccation" {{ old('participationPurpose')=="vaccation" ? 'selected' :''}}>{{__('travelling expense')}} </option>
                                        <option value="savings" {{ old('participationPurpose')=="savings" ? 'selected' :''}}>{{__('savings')}}</option>
                                        <option value="real estate purchase" {{ old('participationPurpose')=="real estate purchase" ? 'selected' :''}}>{{__('real estate purchase')}}</option>
                                        <option value="car purchase" {{ old('participationPurpose')=="car purchase" ? 'selected' :''}}>{{__('car purchase')}}</option>
                                        <option value="car purchase" {{ old('participationPurpose')=="car purchase" ? 'selected' :''}}>{{__('pay off debt')}}</option>
                                    </select>
                                    @if($errors->has('participationPurpose'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('participationPurpose') }}</strong>
                                        </span>
                                    @endif
                                </div>



                            </div>

                            <button type="submit" class="btn btn-success mt-5 mb-4 mb-3 buttons_style">
                                {{__('send the request')}}
                            </button>
                        </form> <br><br>
                    </div>
                </div>



               {{-- @include('notes.recommend-user-notes') --}}



    </div>


@endsection



@section('scripts')

<script>

   var date = new Date();
   var year = date.getFullYear(); //get year
   var month = date.getMonth(); //get month

    //date picker for payback date
    $('#monthPickerContributionStartMonth').datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
        /*
        startDate: new Date(year, month, '01'), //set it here
        endDate: new Date(year+1, month, '31')
        */

       });
   $('#monthPickerContributionStartMonth').datepicker();


    //date picker for payback date
    $('#monthPickerContributionReceiveMonth').datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
        /*
        startDate: new Date(year, month, '01'), //set it here
        endDate: new Date(year+1, month, '31')
        */

       });
   $('#monthPickerContributionReceiveMonth').datepicker();




        // set default dates
        var start = new Date(); // date of today

//set end date of 2 months from now
//var end = new Date(new Date().setMonth(start.getMonth()+2)); // 2 months from today
//var end = new Date(new Date().setYear(start.getFullYear()+1));

 //date picker for payback date
 $('#datepickerPayBackRef').datepicker({
    weekStart: 1,
    daysOfWeekDisabled: [0, 1, 6],     //prevents selection
    autoclose: true,
    startDate : start
    // endDate   : end

 });
 $('#datepickerPayBackRef').datepicker();





</script>

@endsection
