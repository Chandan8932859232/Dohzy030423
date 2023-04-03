@extends('layouts.user')

@section('title', 'Email Verified')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-2">
          <div class="container">
            <div class="jumbotron mt-4 confirm_process_style">
                <h3 class="text-center form_title"><i class="far fa-envelope" style="color:#009175;"></i> {{__('your email address has been verified')}} </h3>
                <hr>

                <h5 class="mt-4">{{__('last thing before using system')}}</h5><br>

                <ul class="nav flex-column">

                    <li class="nav-item mt-2 text-center">
                        <a class="nav-link" href="{{route('register.complete.intro')}}">

                            <button type="button" class="btn buttons_style text-black">
                                {{__('complete your profile')}}
                            </button>

                        </a>
                    </li>

                </ul>

            </div>
          </div>
        </div>

    </div>



@endsection
