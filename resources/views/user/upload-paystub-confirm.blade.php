@extends('layouts.user')

@section('title', 'Upload Paystub')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-2">
          <div class="container">
            <div class="jumbotron mt-4 confirm_process_style">
                <h3 class="text-center form_title"><i class="far fa-thumbs-up"></i> {{__('your pay stub has been successfully uploaded')}} </h3>
                <hr>

            <br>

                <ul class="nav flex-column">

                    <li class="nav-item mt-2 text-center">

                     <button type="button" class="btn buttons_style" style="color:black;">
                        <a class="nav-link" href="{{route('funds-apply.create')}}">{{__('apply for a loan')}}</a>
                     </button>

                    </li>

                </ul>

            </div>
          </div>
        </div>

    </div>



@endsection
