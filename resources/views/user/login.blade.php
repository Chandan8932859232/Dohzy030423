@extends('layouts.user')

@section('title', 'Log In')

@section('content')

    @push('page_specific_style')
       {{--<link href="{{ asset('css/specific_styles/password-strength-hint.css') }}" rel="stylesheet">--}}
    @endpush

   <div class="container">

       <div class="col-sm-6 offset-sm-4">

           <div class="text-center mt-5 form_title" style="color:#312A5C; font-weight:700; "> <a href="{{ route('static-pages.index') }}">
                      {{-- <img src="{{ asset('images/dohzy-logo-black.png') }}" width="100px" height="100px" alt="logo-image"> --}}
                   </a>
               {{__('log in')}}
           </div>
           <hr>

          <form action="{{ route('user.login') }}" method="POST">
           @csrf

              <div class="form-row">

                  <div class="form-group col-sm-12">
            <label class="form_text mt-1"> {{__('email')}}  </label>
            <input type="email" name="email" value="{{ old('email') }}"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                  </div>

                  <div class="form-group col-md-12">

            <label for="password" class="form_text mt-3"> {{__('password')}}  </label>
            <input type="password" name="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg"
                  {{--
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                   --}}
            >


                      <!-- An element to toggle between password visibility -->
                      <input class="mt-2" type="checkbox" onclick="passwordHideShowFunction()"><small> {{__('show password')}}</small>


            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

                  </div>

            <button type="submit" class="btn btn-success btn-block my-3 buttons_style">
                <i class="fas fa-sign-in-alt"></i> {{__('log in')}}</button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}" style="text-decoration: none;">
                        {{ __('forgot your password') }} ?
                    </a>

                  <a class="btn btn-link" href="{{ route('user.register') }}" style="text-decoration: none;">
                      {{__('create account')}}
                  </a>
                @endif
              </div>
          </form>


       </div>



   </div>


<br><br><br><br><br>



@endsection

@section('scripts')

    @include('js-snippets.password-hide-show')

    @include('js-snippets.password-strength-hint')

@endsection

