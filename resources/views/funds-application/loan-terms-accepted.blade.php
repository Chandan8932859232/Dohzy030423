
@extends('layouts.user')

@section('title', 'Loan Accepted')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

            <div class="container">

                <div class="jumbotron mt-4 confirm_process_style">
                    <h3 class="text-center form_title"> <i class="fas fa-check" style="color:#009175;"></i> {{__('loan acceptance process is complete')}} </h3>
                    <hr>
                    
                    <h5 class="mt-4 text-center">{{__('if everything is correct we are going to deposit the funds in your account')}}</h5>
                    
                     <br><br>
                    <ul class="nav flex-column">

                        <li class="nav-item text-center">
                           
                          <a class="nav-link text-center" href="{{route('static-pages.index')}}">
                             <button type="button" class="btn btn-outline-dark"> 
                                <i class="fas fa-arrow-left"></i> 
                                {{__('back to home page')}}
                             </button>
                         </a>   

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

@endsection
