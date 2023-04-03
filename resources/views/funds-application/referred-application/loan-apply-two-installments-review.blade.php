@extends ('layouts.user')

@section('title', __('apply for a loan'))

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : {{__('payment plan')}}</h3>
            <hr>

            <div class="container mt-5 mb-2">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('the interest rate for this loan will be')}} : <strong>{{session('userInterestRate')}}%</strong></p>
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('amount per installment')}} :  <strong>${{session('amountPerInstallment')}}</strong></p>
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('number of installments')}} :  <strong>{{session('numberOfInstallments')}}</strong></p>
                      <p class="ml-1"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('payback amount will be')}} :  <strong>${{session('loanPayBackAmount')}}</strong></p>
                    </div>
                </div>
            </div>

            <div class="container">

                <form method="post" action="{{route('final.loan-review')}}" >
                    @csrf

                  <div class="form-row">


                      <div class="col-md-12 mt-5 installment_payback_date" id="first_installment_payback_date">
                        <label class="form_text">{{__('first installment payback date')}}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBackRef" name="firstInstallmentPayBackDate"
                                   value="{{session('firstInstallmentPayBackDate')}}"
                                   class="form-control {{ $errors->has('firstInstallmentPayBackDate') ? ' is-invalid' : '' }}" readonly/>

                            @if($errors->has('firstInstallmentPayBackDate'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('firstInstallmentPayBackDate') }}</strong>
                             </span>
                            @endif
                        </div>
                        </div>


                        <div class="col-md-12 mt-5 installment_payback_date" id="first_installment_payback_date">
                            <label class="form_text">{{__('first installment payback amount')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$CAD</span>
                                </div>
                                <input type="text"  name="firstInstallmentAmount"
                                       value="{{session('amountPerInstallment')}}"
                                       class="form-control {{ $errors->has('firstInstallmentAmount') ? ' is-invalid' : '' }}" readonly/>

                                @if ($errors->has('firstInstallmentAmount'))
                                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('firstInstallmentAmount') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>




                                <div class="col-md-12 mt-5 installment_payback_date" id="second_installment_payback_date">
                                    <label class="form_text">{{__('second installment payback date')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" data-date-format="yyyy-mm-dd" id="datepickerPayBackRef" name="secondInstallmentPayBackDate"
                                               value="{{session('secondInstallmentPayBackDate')}}"
                                               class="form-control {{ $errors->has('secondInstallmentPayBackDate') ? ' is-invalid' : '' }}" readonly/>

                                        @if ($errors->has('secondInstallmentPayBackDate'))
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('secondInstallmentPayBackDate') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12 mt-5 installment_payback_date" id="second_installment_payback_date">
                                    <label class="form_text">{{__('second installment payback amount')}} </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$CAD</span>
                                        </div>
                                        <input type="text"  name="secondInstallmentAmount"
                                               value="{{session('amountPerInstallment')}}"
                                               class="form-control {{ $errors->has('secondInstallmentAmount') ? ' is-invalid' : '' }}" readonly/>

                                        @if ($errors->has('secondInstallmentAmount'))
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('secondInstallmentAmount') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>


                </div>

                    <br><br><br>

                    <a type="button" href="{{route('two-installments-choose')}}"
                        class="btn btn-outline-dark float-left">
                        <i class="fas fa-arrow-left"></i>  {{__('back')}}
                     </a>

                     <a type="button" href="{{route('final.loan-review')}}"
                         class="btn btn-primary float-right buttons_style" >
                         {{__('next step')}} <i class="fas fa-arrow-right"></i>
                     </a>

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
