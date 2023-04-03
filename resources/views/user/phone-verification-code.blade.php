@extends('layouts.user')

@section('title', 'Phone Verification')

@section('content')



    <div class="row">
        <div class="col-sm-8">

            <h3 class="text-center mt-3 form_title">{{__('provide phone verification code')}}</h3>
            <hr>


            <div class="container mt-5 mb-4">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                       <p class="ml-3 mb-3"> <i class="fas fa-arrow-circle-right site_points"></i>  {{__('the phone verification code was sent to your cell phone')}}</li>
                    </div>
                </div>
            </div>


            <div class="container mt-5">

            <form action="{{ route('validate.verification-code') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">{{__('verification code')}} </label>
                        <input type="tel" style="height:50px;" class="form-control {{ $errors->has('phoneVerificationCode') ? ' is-invalid' : '' }}"
                               name="phoneVerificationCode" value="{{ old('phoneVerificationCode') }}"
                               id="inputPhone">

                        @if ($errors->has('phoneVerificationCode'))
                            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('phoneVerificationCode') }}</strong>
          </span>
                        @endif
                    </div>

                </div>


             <a type="button" href="{{route('phone.provide')}}"
                class="btn btn-outline-dark float-left my-5"> <i class="fas fa-arrow-left"></i>
                {{__('back')}}
              </a>

                <button type="submit" formmethod="post" class="btn btn-success my-5 float-right buttons_style">
                    {{__('verify phone')}} <i class="fas fa-arrow-right"> </i>
                </button>

            </form>
            </div>

        </div>

    </div>


  <br><br><br><br><br><br>


@endsection
