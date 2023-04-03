@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('apply for a loan')}} : {{__('refund in installments')}}</h3>
            <hr>
            {{--
            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> The amount you requested allows you to payback in installments</p>
                        
                    </div>
                </div>
            </div>
            --}}

            <div class="container">

                <form method="post" action="{{route('installment-loan.handle')}}" >
                    @csrf

                  <div class="form-row">  

                    <div class="form-group col-md-6 mt-4 installments_payback" >
                        <label class="form_text mt-2"> {{__('do you want to payback in installments')}} ? </label>

                         <div class="form-check ml-3 mt-2 mb-2">
                            <input class="form-check-input {{ $errors->has('installmentPayBack') ? ' is-invalid' : '' }}"
                                  type="radio" name="installmentPayBack" 
                                  value="1" {{ old('installmentPayBack')=="1" ?'checked':''}} >
                             <label class="form-check-label">{{__('yes')}} </label>
                         </div>
                    
                         <div class="form-check ml-3 mb-3">
                            <input class="form-check-input {{ $errors->has('installmentPayBack') ? ' is-invalid' : '' }}"
                                 type="radio" name="installmentPayBack" 
                                 value="0" {{ old('installmentPayBack')=="0" ?'checked':''}} >
                             <label class="form-check-label">{{__('no')}}</label>

                             @if ($errors->has('installmentPayBack'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('installmentPayBack') }}</strong>
                                </span>
                             @endif
                        </div>
                    </div>   
           
                            

                </div> <br><br>
                  


                    <a type="button" href="{{route('funds-apply.create')}}"
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
