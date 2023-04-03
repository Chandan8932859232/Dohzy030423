@extends('layouts.split')


@section('title', 'User login')

@push('page_specific_style')
    <link href="{{ asset('css/specific_styles/password-strength-hint.css') }}" rel="stylesheet">
@endpush

@section('left-content')



    <div class="row">

        <div class="col-md-4"> <!-- Start login div-->

            <div class="container">
                <div class="text-center"><a href="{{ route('static-pages.index') }}"> <img src="{{ asset('images/dohzy-logo-black.png') }}" width="80px" height="80px" alt="logo-image"> </a> </div>
                <hr>

                <form action="{{ route('user.login') }}" method="POST">
                    @csrf

                    @include('partials._messages')

                    <label for="email" class="mt-1"> Email  </label>
                    <input type="email" name="email" value="{{ old('email') }}"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <label for="password" class="mt-3"> Password  </label>
                    <input type="password" name="psw" id="psw" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                    @endif

                    <button type="submit" class="btn btn-success btn-block my-3 buttons_style"> <i class="fas fa-sign-in-alt"></i> Log In</button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>

                        <a class="btn btn-link" href="{{ route('user.register') }}">
                            Create Account
                        </a>
                    @endif

                </form>
            </div>

        </div>
        @endsection

        @section('right-content')
            <div id="message" class="col mt-2">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>

            <div class="col-md-8 right_side_login">

            </div> <!-- end login page side image-->


    </div>

@endsection
