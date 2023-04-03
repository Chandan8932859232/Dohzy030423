@extends('layouts.user')

@section('title', __('referral code request'))

@section('content')

    <div class="row">

        <div class="col-md-8 offset-sm-0">
            <h3 class="text-center mt-3 form_title">{{__('referral code request')}} </h3>
            <hr class="mb-3">

            <div class="container">

               {{--
                <div class="card mt-4 mb-2">
                    <div class="card-body"> <i class="fas fa-info-circle"></i>
                        {{__('the person you are referring')}}
                    </div>
                </div>
                --}}

                <form method="post" action="{{route('process.referral-code-request')}}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group mt-2  col-md-12">
                            <label>{{__('referral code purpose')}}</label>
                            <select  name="referralCodePurpose" class="form-control {{ $errors->has('relationship') ? ' is-invalid' : '' }}">
                                <option value="">{{__('please select')}}</option>
                                <option value="apply for a loan" {{ old('referralCodePurpose')=='apply for a loan' ? 'selected' :''}}>{{__('apply for a loan')}}</option>
                                <option value="apply for a mortgage" {{ old('referralCodePurpose')=='apply for a mortgage' ? 'selected' :''}}>{{__('apply for a mortgage')}}</option>
                                <option value="apply for insurance" {{ old('referralCodePurpose')=='apply for insurance' ? 'selected' :''}}>{{__('apply for insurance')}}</option>
                            </select>
                            @if ($errors->has('referralCodePurpose'))
                                <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('referralCodePurpose') }}</strong>
                                        </span>
                            @endif
                        </div>


                    </div>

                    <button type="submit" class="btn btn-success mt-3 mb-2 buttons_style">
                        <i class="fas fa-qrcode"></i> {{__('referral code request')}}
                    </button>
                </form>
            </div>
        </div>



       {{-- @include('notes.recommend-user-notes') --}}



    </div>









@endsection
