@extends('layouts.user')

@section('title', 'Begin Account Completion')

@section('content')

<div class="row">

 
        <div class="col-md-8 offset-sm-0">

            <h3 class="text-center mt-3 form_title">{{__('complete your profile')}} </h3>
            <hr>



            <div class="container mt-5 mb-4">

                <form method="post" action="{{route('register.complete')}}" >
                    @csrf




                  <div class="card text-dark notes_style">

                    <div class="card-body">

                        <p style="font-size:15px; font-weight:bold;">  {{__('in order to complete your account you need the following')}} </p>

                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('an identification document')}}</p>

                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('a canada based address')}}  </p>

                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('a canada based cell phone number')}}  </p>

                        <p>  {{__('please have the above handy before starting this process')}} </p>

                    </div>

                  </div>



                 <br><br><br><br><br><br>

                 <a type="button" href="{{route('user-dashboard')}}"
                    class="btn btn-outline-dark float-left">
                    <i class="fas fa-arrow-left"></i>  {{__('back')}}
                 </a>

                  <a type="button" href="{{route('register.complete')}}"
                    class="btn btn-primary float-right buttons_style">
                     {{__('start')}}  <i class="fas fa-arrow-right"></i>
                 </a>

                </form>
            </div>
        </div>



</div>   <br><br><br><br><br>



@endsection
