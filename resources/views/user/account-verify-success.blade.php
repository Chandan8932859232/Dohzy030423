@extends('layouts.user')

@section('title', 'Account Complete Success')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <br><br>

            <div class="container">

            <div class="jumbotron mt-5 confirm_process_style">

                <p class="my-2 text-center">
                 <strong> <i class="fas solid fa-thumbs-up" style="color:#009175; font-size:22px;"></i> <span style="color:#312A5C; font-size:23px;"> {{__('this completes the account verification process')}}</strong>
                </p> <hr>



                    <p class="nav-item mt-4">
                        <a class="nav-link" href="{{ route('funds-apply.create') }}">
                            <i class="fas fa-arrow-circle-right site_points"> </i> <u>{{__('apply for a personal loan')}}</u>
                        </a>
                    </p>


                    <p class="nav-item mt-4">
                        <a class="nav-link" href="{{ route('request.center') }}">
                            <i class="fas fa-arrow-circle-right site_points"> </i> <u>{{__('apply for a business loan')}}</u>
                        </a>
                    </p>


            </div>

            </div>

        </div>



    </div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection
