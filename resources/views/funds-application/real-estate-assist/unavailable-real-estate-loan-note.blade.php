@extends('layouts.user')

@section('title', 'Real Estate Loan')

@section('content')


    <div class="row">

        <div class="col-sm-8 offset-sm-1">


           <div class="container mt-4 mb-4">
                <div class="card text-dark notes_style">
                    <div class="card-body">
                       {{-- <h3 style="font-size: 17px; font-weight:500;"> <i class="fas fa-exclamation-triangle" style="color:orange;"></i> {{__('please note that')}} </h3> --}}

                            <p class="ml-2" style="font-size: 19px; font-weight:600; color:#251F4F;">{{__('what is the real estate assistance loan')}} ?</p>
                           <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"> </i> {{__('this is a loan we offer to our clients to help them get into real estate or cover real estate related expenses')}}</p>

                    </div>
                </div>
            </div>
            <br><br>

            <div class="container">
                <div class="card">

                    <div class="card-header notes_style">
                        <p class="text-center" style="font-size: 20px; font-weight: 500; color:#251F4F;"> <i class="fas fa-exclamation-triangle" style="color:orange;"></i> {{__('no access due to low dohzy score')}}</p>
                    </div>

                    <div class="card-body notes_style">
                        <strong>{{__('what can i do to qualify')}} ? </strong>
                       <ul>
                           <li class="pb-2 pt-2">{{__('pay back your loans on time in order to increase your dohzy score')}}</li>
                           <li class="pb-2">{{__('use dohzy products and services frequently')}} </li>
                       </ul>

                        <a href="{{route('static-pages.index')}}" class="text-center">
                        <button  class="btn btn-outline-dark mt-2">
                            <i class="fas fa-arrow-left"></i> {{__('back to home')}}</button>
                        </a>

                    </div>

                 </div>

              </div>
           </div>


        </div>


    </div>




@endsection
