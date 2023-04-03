
@extends('layouts.user')

@section('title', 'Registration Complete')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-3">

            <div class="container">

             <div class="jumbotron confirm_process_style">
                <h1 class="text-center form_title mb-4" style="font-size: 21px;"> <i class="fas fa-door-open" style="color:#009175;"></i> {{__('welcome to dohzy')}} {{__('account created successfully')}} </h1> <hr>

                <p class="mt-4 ml-4 text-left"><i class="fas fa-arrow-circle-right site_points"> </i> {{__('please go to your email')}} <span style="font-weight: bold; font-size: 18px; color:#312A5C;">  {{$userEmail}} </span> {{__('to verify email')}}</p>

                <p class="mt-2 ml-4 text-left"><i class="fas fa-arrow-circle-right site_points"></i> {{__('the verification link will expire in')}}  <span style="font-weight: bold; font-size: 18px; color:#312A5C;"> {{__('1 hour')}}</span></p>

                <p class="mt-2 ml-4 text-left"><i class="fas fa-arrow-circle-right site_points"></i> {{__('please check spam')}} </p>

            </div>

            </div>

        </div>



        </div>


    <br><br><br><br><br>


@endsection
