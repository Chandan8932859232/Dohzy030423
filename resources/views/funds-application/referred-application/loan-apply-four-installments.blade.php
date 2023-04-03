@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : Four Installments </h3>
            <hr>

            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> Based on your request amount of $$$ you can pay back in installments</p>
                      {{-- <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('you need a')}}<strong> {{__('referral code')}}</strong> {{__('to apply for a loan')}}. {{__('if you do not have one please')}} <a href="{{route('request.referral-code')}}"><u style="color:#5f5fd4">{{__('request a referral code')}}</u></a></p> --}}
                    </div>
                </div>
            </div>

            <div class="container">

                <form method="post" action="{{route('funds-apply.store')}}" >
                    @csrf

                  <div class="form-row">  


                        <div class="col-md-6 mt-4 installment_payback_date" id="first_installment_payback_date">
                            <label class="form_text">First installment payback amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$CAD</span>
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
                        
                        
                      <div class="col-md-6 mt-4 installment_payback_date" id="first_installment_payback_date">
                        <label class="form_text">First installment payback date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> 
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



                            <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                <label class="form_text">Second installment payback amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$CAD</span>
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

                                <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                    <label class="form_text">Second installment payback date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> 
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


                                <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                    <label class="form_text">Third installment payback amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$CAD</span>
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
    
                                    <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                        <label class="form_text">Third installment payback date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> 
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


                                    <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                        <label class="form_text">Fourth installment payback amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$CAD</span>
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
        
                                        <div class="col-md-6 mt-4 installment_payback_date" id="second_installment_payback_date">
                                            <label class="form_text">Fourth installment payback date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> 
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
                                                        

                </div>

                    <button type="submit" id="loanApply" class="btn btn-primary mt-4 mb-4 buttons_style">
                        <i class="far fa-paper-plane"></i> {{__('apply for a loan')}}
                    </button>
                </form>
            </div>
        </div>

   {{--@include('notes.loan-apply-notes')--}}



    </div>


@endsection


@section('scripts')
    <script>
     
    


    </script>
@endsection
