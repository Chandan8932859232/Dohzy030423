

@extends('layouts.user')

@section('title', 'Loan Accepted')

@section('content')


    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <div class="container">

                <div class="jumbotron">
                    <h2 class="form_title text-center"> <i class="far fa-frown text-danger"></i> {{__('the processing of this application will be stopped and no further action will be taken')}} </h2>

                    <hr>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link" href="/"> <i class="fas fa-home"></i> {{__('home')}}</a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>


    </div>




@endsection
