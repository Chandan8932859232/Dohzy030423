@extends('layouts.user')

@section('title', 'Log out')

@section('content')


    <div class="row">
        <div class="col-sm-8 offset-sm-3">

           <div class="container">

            <div class="jumbotron mt-5" style="background-color: #F8F8FF;">
                <h1 class="form_title text-center" > <i class="fas fa-hand-peace"></i> {{__('good bye hope to see you later')}} </h1>
                <hr>
                <h4 class="mt-4 mb-3">{{__('You can also visit the following')}} </h4>


                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('static-pages.index')}}"> <i class="fas fa-home"></i> {{__('home')}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login')}}"> <i class="fas fa-sign-in-alt"></i> {{__('log in')}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.register')}}"> <i class="fas fa-user"></i> {{__('register')}}</a>
                    </li>

                </ul>

            </div>

           </div>

        </div>


    </div>


<br><br><br><br><br>

@endsection
