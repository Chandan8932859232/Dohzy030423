@extends('layouts.user')

@section('title', 'Business Account Request Complete')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <br><br><br><br>

            <div class="container">

            <div class="jumbotron mt-5 confirm_process_style">

                <p class="mt-2 text-center">
                 <strong><i class="far fa-check-circle" style="color:#009175; font-size:22px;"></i> <span style="color:#312A5C; font-size:20px;"> {{__('your business account request is complete. your request will be processed and we shall get back to you in 48 hours')}}</strong>
                </p>

                <ul class="nav flex-column">

                    <li class="nav-item mt-4 text-center">
                        <a class="nav-link" href="{{route('static-pages.index')}}">

                            <button type="button" class="btn buttons_style" style="color:#000000;">
                                 {{__('back to home')}}
                            </button>

                        </a>
                    </li>

                </ul>

            </div>

            </div>

        </div>



    </div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection
