@extends ('layouts.admin')

@section('title', 'Assign Referral Code')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 class="text-center mt-3">Assign Referral Code To User </h3> <hr>

            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                         <h3 style="font-size: 17px; font-weight:500;"> <i class="fas fa-exclamation-triangle" style="color:orange;"></i> This will do the following </h3>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> Assign the referral code to the user</p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> Change the status of the referral code from 0 to 1 (unused to used) </p>

                    </div>
                </div>
            </div>
            <div>

                <form method="post" action="{{ route('assign.referral-code') }}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Referral Code </label>
                            <input type="text" name="referralCode" value="{{ old('referralCode') }}" class="form-control {{ $errors->has('referralCode') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('referralCode'))
                                <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('referralCode') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label>User Id </label>
                            <input type="text" name="userId" value="{{ old('userId') }}" class="form-control {{ $errors->has('userId') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('userId'))
                                <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('userId') }}</strong>
                                        </span>
                            @endif
                        </div>


                    </div>
                    <button type="submit" class="btn btn-dohzy btn-block my-3">Assign User To Code</button>
                </form>
            </div>
        </div>
    </div>



@endsection
