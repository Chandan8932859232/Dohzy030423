@extends ('layouts.admin')

@section('title', 'Loan Charge')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">Loan Charge </h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> Submitting a charge will do the following</strong>
                    <ul><li>Inrease the loan balance of the loan</li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="container">

                <form method="post" action="{{route('handle.loan-charge')}}">
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

                            <label class="form_text">Charge amount ($CAD)  </label>
                            <input type="text"  name="chargeAmount"
                                   value="{{old('chargeAmount')}}"
                                   class="form-control {{ $errors->has('chargeAmount') ? ' is-invalid' : '' }}" />

                                  @if ($errors->has('chargeAmount'))
                                       <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('chargeAmount') }}</strong>
                                       </span>
                                  @endif
                        </div>


                     <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Charge Type </label>
                            <input type="text"  name="chargeType"
                                   value="{{old('chargeType')}}"
                                   class="form-control {{ $errors->has('chargeType') ? ' is-invalid' : '' }}" />

                                  @if ($errors->has('chargeType'))
                                       <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('chargeType') }}</strong>
                                       </span>
                                  @endif
                        </div>


                        <button type="submit" class="btn btn-dark btn-block mt-4 mb-5 ">
                            Apply Charge
                        </button>

                </form>
            </div>
        </div>






    </div>


@endsection






@section('scripts')



@endsection




