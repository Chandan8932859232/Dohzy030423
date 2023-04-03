@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : {{__('number of installments')}}</h3>
            <hr>

           {{--
            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('money will be sent to you by')}} <strong>{{__('interac etransfer')}}</strong></p>
                    </div>
                </div>
            </div>
            --}}

            <div class="container">

                <form method="post" action="{{route('installment-number.handle')}}" >
                    @csrf

                  <div class="form-row">

                    <div class="form-group col-md-6 mt-4 installments" id="number_of_installments">
                        <label class="form_text mt-2"> {{__('number of installments')}} </label>

                         <div class="form-check ml-3 mb-3" id ="two_installments">
                             <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                    type="radio" name="possibleInstallments"  id ="two_payments" value="2"  >

                             <label class="form-check-label" for="exampleRadios1">{{__('two')}} </label>
                         </div>

                         <div class="form-check ml-3 mb-3" id ="three_installments" >
                             <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                    type="radio" name="possibleInstallments" id="three_payments" value="3" >

                             <label class="form-check-label" for="exampleRadios2">{{__('three')}}</label>
                         </div>
                          {{--
                         <div class="form-check ml-3 mb-3" id ="four_installments" >
                             <input class="form-check-input {{ $errors->has('autoDepositEnabled') ? ' is-invalid' : '' }}"
                                    type="radio" name="possibleInstallments" id="four_payments"  value="4">

                                    <label class="form-check-label" for="exampleRadios2">Four</label>
                         </div>
                        --}}

                     </div>

                </div> <br><br>

                <a type="button" href="{{route('decide-installment-loan.show')}}"
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
    <script>




    </script>
@endsection
