@extends('layouts.user')

@section('title', 'Loan Pay')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-2">
          
          <div class="container">  

            <div class="jumbotron mt-4 confirm_process_style">

              <p class="mt-2 text-center">
                <strong><i class="fas fa-check" style="color:#009175;"></i> <span style="color:#312A5C; font-size:20px;">  {{__('thanks for the payment')}} </strong>
              </p>
                
                <hr>

                <br>

               <h5 class="text-center">{{__('we are going to verify the payment')}}</h5><br>
                
               <ul class="nav flex-column">
                 
                <li class="nav-item mt-4">

                  <a class="nav-link text-center" href="{{route('static-pages.index')}}">

                    <button type="button" class="btn btn-outline-dark"> <i class="fas fa-arrow-left"></i> {{__('back to home page')}}</button>
                  </a>
                </li>             

                </ul> 

           
            </div>
          </div>  
        </div>

    </div>



@endsection
