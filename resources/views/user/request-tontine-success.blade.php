@extends('layouts.user')

@section('title', 'Request Tontine Success')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <br><br><br>

            <div class="container">

            <div class="jumbotron mt-5 confirm_process_style">

                <p class="mt-2 text-center">
                 <strong><i class="far fa-check-circle" style="color:#009175; font-size:22px;"></i> <span style="color:#312A5C; font-size:20px;"> {{__('your request has been received. We shall process it and get back to you with a response')}}</strong>
                </p>

                <ul class="nav flex-column">

                    <li class="nav-item mt-4 text-center">
                        <a class="nav-link" href="{{route('static-pages.index')}}">

                            <button type="button" class="btn buttons_style" style="color:black;">
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
