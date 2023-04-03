@extends ('layouts.admin')

@section('title', 'Loan Limit Change')

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-1">
            <h3 class="text-center mt-5">Change Loan Limit </h3>

            <div class="card">
                <div class="card-body">
                    <strong><i class="fas fa-info-circle"></i> List of levels and loan range</strong>
                      <ul>
                          <li>Level 1 : $100 - $200</li>
                          <li>Level 2 : $100 - $300</li>
                          <li>Level 3 : $100 - $500 </li>
                          <li>Level 4 : $100 - $700</li>
                          <li>Level 5 : $100 - $1000 </li>
                          <li>Level 8 :  $500 - $2500 </li>
                </div>
            </div>
            <hr>

            <div class="container">

                <form method="post" action="{{route('admin.change-loan-limit')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">User Id</label>
                            <input type="text"  name="userId"
                                   value="{{old('userId', $userInfo->id)}}"
                                   class="form-control {{ $errors->has('userId') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('userId'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('userId') }}</strong>
                           </span>
                            @endif

                        </div>

                          
                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Current User Loan Level  </label>
                            <input type="text"  name="currentLoanLevel"
                                   value="{{old('currentLoanLevel', $currentLoanLevel)}}"
                                   class="form-control {{ $errors->has('currentLoanLevel') ? ' is-invalid' : '' }}" readonly/>

                            @if ($errors->has('currentLoanLevel'))
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('currentLoanLevel') }}</strong>
                               </span>
                            @endif

                        </div>

   
                        <div class="form-group col-md-6 mt-4">

                            <label class="form_text">Target Loan Level  </label>
                            <input type="text"  name="targetLoanLevel"
                                   value="{{old('targetLoanLevel')}}"
                                   class="form-control {{ $errors->has('targetLoanLevel') ? ' is-invalid' : '' }}" />

                            @if ($errors->has('targetLoanLevel'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('targetLoanLevel') }}</strong>
                           </span>
                            @endif

                        </div>

                       

                        <br>

                    <button type="submit" class="btn btn-dark btn-block mt-3 mb-5 ">
                        <i class="far fa-paper-plane"></i> Change Loan Limit
                    </button>
                </form>
            </div>
        </div>






    </div>


@endsection


@section('scripts')

@endsection
